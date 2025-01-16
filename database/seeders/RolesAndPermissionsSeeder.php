<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactivar restricciones de claves foráneas
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Vaciar tablas relacionadas
        \DB::table('role_has_permissions')->truncate();
        \DB::table('model_has_roles')->truncate();
        \DB::table('model_has_permissions')->truncate();
        Role::truncate();
        Permission::truncate();

        // Reactivar restricciones de claves foráneas
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Crear permisos
        $permissions = [
            'dashboard.list',
            'ventas-list',
            'ventas-create',
            'ventas-report',
            'ventas-override',
            'ventas-delete',
            'ventas-enlaces',
            'ventas-create-client',
            'ventas-create-product',
            'ventas-close-caj',
            'admin-list'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear rol y asignar permisos al rol
        $role = Role::firstOrCreate(['name' => 'Admin']);
        $role->syncPermissions($permissions);

        // Asignar rol y permisos al usuario con id = 1
        $user = User::find(1);
        if ($user) {
            $user->assignRole($role);
            $user->syncPermissions($permissions);
        } else {
            $this->command->info('Usuario con id 1 no encontrado.');
        }
    }
}
