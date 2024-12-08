<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:display roles|create roles|view roles|edit roles|delete roles', ['only' => ['index']]);
        $this->middleware('permission:create roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:view roles', ['only' => ['show']]);
        $this->middleware('permission:edit roles', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete roles', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = DB::table('roles')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        function permissions($name)
        {
            $permissions = DB::table('permissions')->where('name', 'like', $name)->get();
            return $permissions;
        }

        $user_permissions = permissions('%users%');
        $prospect_permissions = permissions('%prospects%');
        $customer_permissions = permissions('%customers%');
        $appointment_permissions = permissions('%appointments%');
        $consultation_permissions = permissions('%consultations%');
        $port_permissions = permissions('% ports%');
        $shipment_permissions = permissions('%shipments%');
        $equipment_permissions = permissions('%equipments%');
        $customization_permissions = permissions('%customizations%');
        $report_permissions = permissions('%reports%');
        $role_permissions = permissions('%roles%');

        return view('roles.create', compact(
            'user_permissions',
            'prospect_permissions',
            'customer_permissions',
            'appointment_permissions',
            'consultation_permissions',
            'port_permissions',
            'shipment_permissions',
            'equipment_permissions',
            'customization_permissions',
            'report_permissions',
            'role_permissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);
        $role->givePermissionTo($validated['permissions']);

        return redirect()->route('roles.index')->with('success', 'Rôle créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = DB::table('roles')->where('id', $id)->first();

        $assigned_permissions  = DB::table('role_has_permissions')
            ->join('permissions', 'role_has_permissions.permission_id', 'permissions.id')
            ->where('role_id', $id)
            ->pluck('permissions.name')
            ->toArray();

        function show_permissions($name)
        {
            $all_role_permissions = DB::table('permissions')
                ->where('name', 'like', $name)
                ->orderBy('id')
                ->pluck('name')
                ->toArray();

            return $all_role_permissions;
        }

        $user_permissions = show_permissions('%users%');
        $prospect_permissions = show_permissions('%prospects%');
        $customer_permissions = show_permissions('%customers%');
        $appointment_permissions = show_permissions('%appointments%');
        $consultation_permissions = show_permissions('%consultations%');
        $port_permissions = show_permissions('% ports%');
        $shipment_permissions = show_permissions('%shipments%');
        $equipment_permissions = show_permissions('%equipments%');
        $customization_permissions = show_permissions('%customizations%');
        $report_permissions = show_permissions('%reports%');
        $role_permissions = show_permissions('%roles%');

        return view('roles.show', compact(
            'role',
            'assigned_permissions',
            'user_permissions',
            'prospect_permissions',
            'customer_permissions',
            'appointment_permissions',
            'consultation_permissions',
            'port_permissions',
            'shipment_permissions',
            'equipment_permissions',
            'customization_permissions',
            'report_permissions',
            'role_permissions',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = DB::table('roles')->where('id', $id)->first();

        $assigned_permissions  = DB::table('role_has_permissions')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_id', $id)
            ->pluck('permissions.name')
            ->toArray();

        function edit_permissions($name)
        {
            $permissions = DB::table('permissions')->where('name', 'like', $name)->get();
            return $permissions;
        }

        $user_permissions = edit_permissions('%users%');
        $prospect_permissions = edit_permissions('%prospects%');
        $customer_permissions = edit_permissions('%customers%');
        $appointment_permissions = edit_permissions('%appointments%');
        $consultation_permissions = edit_permissions('%consultations%');
        $port_permissions = edit_permissions('% ports%');
        $shipment_permissions = edit_permissions('%shipments%');
        $equipment_permissions = edit_permissions('%equipments%');
        $customization_permissions = edit_permissions('%customizations%');
        $report_permissions = edit_permissions('%reports%');
        $role_permissions = edit_permissions('%roles%');

        return view('roles.edit', compact(
            'role',
            'assigned_permissions',
            'user_permissions',
            'prospect_permissions',
            'customer_permissions',
            'appointment_permissions',
            'consultation_permissions',
            'port_permissions',
            'shipment_permissions',
            'equipment_permissions',
            'customization_permissions',
            'report_permissions',
            'role_permissions',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role = Role::find($id);
        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions']);

        return redirect()->route('roles.edit', $id)->with('success', 'Rôle mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);

        if ($role) {
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Rôle supprimé avec succès !');
        }
    }
}
