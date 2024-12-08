<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $auth_user = auth()->id();

        $user = DB::table('users')->where('id', $auth_user)->first();
        $user->created_at = Carbon::parse($user->created_at)->format('d/m/Y');

        $prospects = DB::table('prospects')->where('user_id', $auth_user)->where('status', '!=', 'customer')->get();
        foreach ($prospects as $prospect) {
            $prospect->next_followup_date = Carbon::parse($prospect->next_followup_date)->format('d/m/Y - H:m');
            $prospect->status = $prospect->status === 'new' ? 'Nouveau' : ($prospect->status === 'interested' ? 'Intéressé' : ($prospect->status === 'not interested' ? 'Pas intéressé' : ''));
        }

        $customers = DB::table('prospects')->where('user_id', $auth_user)->where('status', 'customer')->get();

        $appointments = DB::table('appointments')
            ->join('prospects', 'appointments.prospect_id', 'prospects.id')
            ->select('prospects.name', 'prospects.company', 'appointments.*')
            ->where('appointments.user_id', $auth_user)
            ->orderBy('appointment_date', 'desc')
            ->get();
        foreach ($appointments as $appointment) {
            $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->format('m/d/Y - H:m');
            $appointment->outcome = $appointment->outcome === 'success' ? 'Succès' : ($appointment->outcome === 'pending' ? 'En attente' : ($appointment->outcome === 'fail' ? 'Échec' : ''));
        }

        $role = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->join('users', 'model_has_roles.model_id', 'users.id')
            ->select('roles.*')
            ->where('users.id', $auth_user)
            ->first();

        return view('user-profile.show', compact('user', 'prospects', 'customers', 'appointments', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $auth_user = auth()->id();

        $user = DB::table('users')->where('id', $auth_user)->first();

        $role = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->join('users', 'model_has_roles.model_id', 'users.id')
            ->select('roles.*')
            ->where('users.id', $auth_user)
            ->first();

        return view('user-profile.edit', compact('user', 'role'));
    }

    /**
     * Details.
     */
    public function details(Request $request)
    {
        $auth_user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'unique:users,email,' . $auth_user->id],
            'phone_number' => 'nullable|string|max:15',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('img')) {
            if ($auth_user->img) {
                Storage::delete($auth_user->img);
            }

            $validated['img'] = $request->file('img')->store('images', 'public');
        }

        $user = User::find($auth_user->id);

        $user->update($validated);

        return redirect()->route('profile.edit');
    }

    /**
     * Password.
     */
    public function password(Request $request)
    {
        $validated = $request->validate([
            'old-password' => 'required|string|min:8',
            'new-password' => 'required|string|min:8',
            'confirm-password' => 'required|string|min:8',
        ]);

        $auth_user = auth()->user();

        $user = User::find($auth_user->id);

        if (!Hash::check($validated['old-password'], $auth_user->password)) {
            return redirect()->route('profile.edit')->with('error', 'Old password is incorrect.');
        }

        if ($validated['new-password'] !== $validated['confirm-password']) {
            return redirect()->route('profile.edit')->with('error', 'New password and confirmation do not match.');
        }

        $user->update([
            'password' => Hash::make($validated['new-password']),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8'
        ]);

        $auth_user = auth()->user();

        $user = User::find($auth_user->id);

        if (!Hash::check($validated['password'], $auth_user->password)) {

            return redirect()->route('profile.edit')->with('error', 'The password is incorrect !');
        }

        $user->delete();

        return redirect()->route('login');
    }
}
