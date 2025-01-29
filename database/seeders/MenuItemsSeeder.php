<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItems;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dashboard = MenuItems::create([
            'title' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => 'heroicon-o-home',
            'permission_name' => 'dashboard.view',
            'order' => 1,
        ]);

        // Menú de Ventas
        $ventas = MenuItems::create([
            'title' => 'Ventas',
            'route' => 'ventas.list',
            'icon' => 'heroicon-o-check-circle',
            'permission_name' => 'ventas.view',
            'order' => 2,
        ]);

        // Submenús de Ventas
        MenuItems::create([
            'title' => 'Nueva Venta',
            'route' => 'ventas.create',
            'icon' => 'heroicon-o-shopping-cart',
            'permission_name' => 'ventas.create',
            'parent_id' => $ventas->id,
            'order' => 1,
        ]);

        MenuItems::create([
            'title' => 'Reportes',
            'route' => 'ventas.report',
            'icon' => 'heroicon-o-document-text',
            'permission_name' => 'ventas.generate-report',
            'parent_id' => $ventas->id,
            'order' => 2,
        ]);

        MenuItems::create([
            'title' => 'Anulación',
            'route' => 'ventas.override',
            'icon' => 'heroicon-o-x-circle',
            'permission_name' => 'ventas.override',
            'parent_id' => $ventas->id,
            'order' => 3,
        ]);

        MenuItems::create([
            'title' => 'Borrar',
            'route' => 'ventas.delete',
            'icon' => 'heroicon-o-trash',
            'permission_name' => 'ventas.delete',
            'parent_id' => $ventas->id,
            'order' => 4,
        ]);

        MenuItems::create([
            'title' => 'Enlaces',
            'route' => 'ventas.enlaces',
            'icon' => 'heroicon-o-link',
            'permission_name' => 'ventas.manage-links',
            'parent_id' => $ventas->id,
            'order' => 5,
        ]);

        MenuItems::create([
            'title' => 'Nuevo Cliente',
            'route' => 'ventas.create.client',
            'icon' => 'heroicon-o-user-plus',
            'permission_name' => 'ventas.create-client',
            'parent_id' => $ventas->id,
            'order' => 6,
        ]);

        MenuItems::create([
            'title' => 'Nuevo Producto',
            'route' => 'ventas.create.product',
            'icon' => 'heroicon-o-archive-box',
            'permission_name' => 'ventas.create-product',
            'parent_id' => $ventas->id,
            'order' => 7,
        ]);

        MenuItems::create([
            'title' => 'Cierre de Caja',
            'route' => 'ventas.close.cash',
            'icon' => 'heroicon-c-currency-euro',
            'permission_name' => 'ventas.close-cash-register',
            'parent_id' => $ventas->id,
            'order' => 8,
        ]);

        // Menú de Administración
        $admin = MenuItems::create([
            'title' => 'Administración',
            'route' => 'admin.list',
            'icon' => 'heroicon-o-cog',
            'permission_name' => 'admin.view',
            'order' => 3,
        ]);

        // Submenús de Administración
        MenuItems::create([
            'title' => 'Gestión de Roles',
            'route' => 'admin.roles',
            'icon' => 'heroicon-o-shield-check',
            'permission_name' => 'admin.manage-roles',
            'parent_id' => $admin->id,
            'order' => 1,
        ]);

        MenuItems::create([
            'title' => 'Gestión de Usuarios',
            'route' => 'admin.users',
            'icon' => 'heroicon-o-user-group',
            'permission_name' => 'admin.manage-users',
            'parent_id' => $admin->id,
            'order' => 2,
        ]);
    }
}
