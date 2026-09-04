<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reinicia las políticas de caché de permisos y roles
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Crear permisos inciales
        $permisos = [
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios'
        ];

        foreach ($permisos as $permiso) {
            Permission::create(
                ['name' => $permiso]
            );
        }

        // 2. Crear los roles y asignar los permisos
        $admin = Role::create(
            ["name" => "admin"]
        );
        $admin->syncPermissions(Permission::all());

        $usuarioAdmin = User::create(
            [
                "email" => "admin@mail.com",
                "name" => "admin",
                "password" => bcrypt("password"),
                "email_verified_at" => now()
            ]
        );

        $usuarioAdmin->assignRole('admin');
    }
}
