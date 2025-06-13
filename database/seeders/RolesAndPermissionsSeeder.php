<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission; 
use Illuminate\Support\Facades\Hash; 

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        
        Permission::firstOrCreate(['name' => 'view users', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'create users', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'edit users', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'delete users', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'manage roles', 'guard_name' => 'web']); // Para gestionar roles
        Permission::firstOrCreate(['name' => 'manage permissions', 'guard_name' => 'web']); // Para gestionar permisos

        // añadir más permisos 
        // Permission::firstOrCreate(['name' => 'create posts', 'guard_name' => 'web']);
        // Permission::firstOrCreate(['name' => 'edit posts', 'guard_name' => 'web']);

       
        $roleSuperadmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $roleEditor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $roleViewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);


        // 4. Asignar permisos a roles
        // El rol 'superadmin' obtiene todos los permisos
        $roleSuperadmin->givePermissionTo(Permission::all());

        // El rol 'admin' puede gestionar usuarios y quizás algunas cosas más
        $roleAdmin->givePermissionTo(['view users', 'create users', 'edit users', 'delete users']);
        // $roleAdmin->givePermissionTo(['create posts', 'edit posts']); // Ejemplo de otros permisos

        // El rol 'editor' puede editar posts pero no gestionar usuarios
        $roleEditor->givePermissionTo(['view users']); // Puede ver usuarios, pero no gestionar
        // $roleEditor->givePermissionTo(['create posts', 'edit posts']); // Ejemplo de otros permisos

        // 5. Asignar roles a usuarios
        // Opción A: Encontrar un usuario existente y asignarle el rol 'superadmin'
        $superadminUser = User::where('email', 'tu_email_superadmin@example.com')->first(); // ¡CAMBIA ESTE EMAIL!

        if ($superadminUser) {
            $superadminUser->assignRole($roleSuperadmin);
            $this->command->info('Rol superadmin asignado a ' . $superadminUser->email);
        } else {
            $this->command->warn('No se encontró usuario con el email tu_email_superadmin@example.com. Creando uno...');
            // Opción B: Crear un usuario nuevo y asignarle el rol 'superadmin'
            $superadminUser = User::firstOrCreate(
                ['email' => 'tu_email_superadmin@example.com'], // Busca por email
                [
                    'name' => 'Super Admin',
                    'password' => Hash::make('password'), // ¡CAMBIA ESTA CONTRASEÑA EN PRODUCCIÓN!
                    'email_verified_at' => now(),
                ]
            );
            $superadminUser->assignRole($roleSuperadmin);
            $this->command->info('Usuario superadmin creado y rol asignado.');
        }

        // Asignar otros roles a otros usuarios si los tienes
        // $adminUser = User::where('email', 'admin@example.com')->first();
        // if ($adminUser) {
        //     $adminUser->assignRole($roleAdmin);
        // }
    }
}