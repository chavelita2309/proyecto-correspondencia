<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisosSeeder extends Seeder
{
    public function run()
    {
        // Lista de permisos generales
        $permisos = [
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'ver roles',
            'crear roles',
            'editar roles',
            'eliminar roles',
            'ver permisos',
            'editar permisos',
            'ver correspondencia',
            'registrar correspondencia',
            'editar correspondencia',
            'eliminar correspondencia',
            'ver detalles de correspondencia',
            'derivar correspondencia',
            'generar reportes',

            'ver búsqueda',
            'ver por referencia',
            'ver mis trámites',
            'ver trámites recibidos',
            'ver trámites pendientes',
            'ver trámites conluidos',
        ];

        // Crear permisos
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles si no existen
        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $director = Role::firstOrCreate(['name' => 'director']);
        $funcionario = Role::firstOrCreate(['name' => 'funcionario']);

        // Asignar todos los permisos al superadmin
        $superadmin->syncPermissions(Permission::all());

        // Asignar permisos al director 
        $director->syncPermissions([

            'generar reportes',
            'derivar correspondencia',
            'ver búsqueda',
            'ver por referencia',
            'ver trámites recibidos',
            'ver trámites pendientes',
            'ver trámites conluidos',
        ]);

        // Asignar solo ciertos permisos al funcionario
        $funcionario->syncPermissions([
            'ver búsqueda',
            'ver por referencia',
            'ver mis trámites',
            'derivar correspondencia',
        ]);
    }
}
