<?php

namespace Database\Seeders;

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

        // Crear permisos con nombres consistentes y estructurados
        $permissions = [
            'dashboard.view',
            'ventas.view',
            'ventas.create',
            'ventas.generate-report',
            'ventas.override',
            'ventas.delete',
            'ventas.manage-links',
            'ventas.create-client',
            'ventas.create-product',
            'ventas.close-cash-register',
            'admin.view',
            'admin.manage-roles',
            'admin.manage-users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear rol con nombre más claro y asignar permisos
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);
        $adminRole->syncPermissions($permissions);

        // Asignar rol y permisos al usuario con ID 1
        $user = User::find(1);
        if ($user) {
            $user->assignRole($adminRole);
            $user->syncPermissions($permissions);
        } else {
            $this->command->info('⚠ Usuario con ID 1 no encontrado.');
        }
    }
}
