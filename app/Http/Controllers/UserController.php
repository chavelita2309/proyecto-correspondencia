<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserController extends Controller
{
    public function index()
    {

        $usuarios = User::with('roles')->get();
        $roles = Role::all();
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.crear', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,name',


        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        $usuario->syncRoles($request->input('roles', []));

        // Crear perfil vacío
        Profile::create([
            'titulo' => 'Sin título',
            'biografia' => '',
            'user_id' => $usuario->id,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        $userRoles = $usuario->roles->pluck('name')->toArray();
        return view('usuarios.editar', compact('usuario', 'roles', 'userRoles'));
    }

    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,name',
        ]);

        $usuario = User::findOrFail($id);

        // Actualiza nombre y correo
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Si se envió una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $usuario->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Actualizar rol
        $usuario->syncRoles($request->input('roles', []));

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
    public function cambiarRol(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $usuario = User::findOrFail($id);
        $role = Role::findById($request->role_id);


        if ($usuario->hasRole('superadmin')) {
            return redirect()->back()->with('error', 'No se puede modificar el rol del superadmin.');
        }

        $usuario->syncRoles([$role->name]);

        return redirect()->back()->with('success', 'Rol actualizado correctamente.');
    }
    //gestionar permisos
    public function editPermissions($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        $userPermissions = $user->permissions->pluck('name')->toArray();
        return view('usuarios.permisos', compact('user', 'permissions', 'userPermissions'));
    }

    public function updatePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->syncPermissions($request->input('permissions', []));
        return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
    }
}
