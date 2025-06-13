<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.crear');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente');
    }

    public function edit(Role $role)
    {
        $permisos = Permission::all();
        $permisosAsignados = $role->permissions->pluck('name')->toArray();
        return view('roles.editar', compact('role', 'permisos', 'permisosAsignados'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->input('permisos', []));
        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente');
    }
    public function editPermisos(Role $role)
    {
        $permisos = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('roles.permisos', compact('role', 'permisos', 'rolePermissions'));
    }

    public function updatePermisos(Request $request, Role $role)
    {
        $role->syncPermissions($request->permisos ?? []);
        return redirect()->route('roles.index')->with('success', 'Permisos actualizados correctamente');
    }
}
