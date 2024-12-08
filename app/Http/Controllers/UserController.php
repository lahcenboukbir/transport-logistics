<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display users|create users|view users|edit users|delete users|manage status users', ['only' => ['index']]);
        $this->middleware('permission:create users', ['only' => ['create', 'store']]);
        $this->middleware('permission:view users', ['only' => ['show']]);
        $this->middleware('permission:edit users', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete users', ['only' => ['destroy']]);
        $this->middleware('permission:manage status users', ['only' => ['activation']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->join('users', 'model_has_roles.model_id', 'users.id')
            ->select('users.*', 'roles.name as role_name', 'roles.id as role_id')
            ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = DB::table('roles')->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'exists:roles,id'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('images', 'public');
        }

        $user = User::create($validated);

        // Find and assign the role:
        $role = Role::find($validated['role_id']);
        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $user->created_at = Carbon::parse($user->created_at)->format('d/m/Y');

        $prospects = DB::table('prospects')->where('user_id', $id)->where('status', '!=', 'customer')->get();
        foreach ($prospects as $prospect) {
            $prospect->next_followup_date = Carbon::parse($prospect->next_followup_date)->format('d/m/Y - H:m');
        }

        $customers = DB::table('prospects')->where('user_id', $id)->where('status', 'customer')->get();

        $appointments = DB::table('appointments')
            ->join('prospects', 'appointments.prospect_id', 'prospects.id')
            ->select('prospects.name', 'prospects.company', 'appointments.*')
            ->where('appointments.user_id', $id)
            ->orderBy('appointment_date', 'desc')
            ->get();
        foreach ($appointments as $appointment) {
            $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->format('m/d/Y - H:m');
        }

        $role = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->join('users', 'model_has_roles.model_id', 'users.id')
            ->select('roles.id', 'roles.name')
            ->where('users.id', $id)
            ->first();

        return view('users.show', compact('user', 'prospects', 'customers', 'appointments', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $user = DB::table('users')->where('id', $id)->first();

        // $roles = DB::table('roles')->get();
        // $assigned_role = DB::table('model_has_roles')
        //     ->join('roles', 'model_has_roles.role_id', 'roles.id')
        //     ->join('users', 'model_has_roles.model_id', 'users.id')
        //     ->select('roles.id', 'roles.name')
        //     ->where('users.id', $id)
        //     ->first();

        // return view('users.edit', compact('user', 'roles', 'assigned_role'));


        $role_id = DB::table('roles')->first()->id;
        $user = DB::table('users')->where('id', $id)->first();
        $role_check = DB::table("model_has_roles")->where("role_id", 1)->where("model_id", $user->id)->exists();

        if ($role_check == false) {

            $roles = DB::table('roles')->get();
            $assigned_role = DB::table('model_has_roles')
                ->join('roles', 'model_has_roles.role_id', 'roles.id')
                ->join('users', 'model_has_roles.model_id', 'users.id')
                ->select('roles.id', 'roles.name')
                ->where('users.id', $id)
                ->first();
            return view('users.edit', compact('user', 'roles', 'assigned_role'));
        } else {

            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'password' => 'nullable|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'exists:roles,id'
        ]);

        $user = User::find($id);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('img')) {
            if ($user->img) {
                Storage::delete($user->img);
            }

            $validated['img'] = $request->file('img')->store('images', 'public');
        }

        $user->update($validated);

        // Update the user's role if role_id is provided
        if ($request->filled('role_id')) {
            $role = Role::find($validated['role_id']);
            $user->assignRole($role);
        }


        return redirect()->route('users.edit', $id)->with('success', 'Utilisateur mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès !');
        }
    }

    /**
     * Activation.
     */
    public function activation(string $id)
    {
        $user = User::find($id);

        if ($user->is_active === 1) {
            $user->update([
                'is_active' => 0
            ]);
        } else {
            $user->update([
                'is_active' => 1
            ]);
        }

        return redirect()->route('users.index')->with('success', "Statut d'activation de l'utilisateur mis à jour avec succès !");
    }
}
