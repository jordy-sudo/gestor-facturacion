<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'permission_name' => 'dashboard.list', 
            'order' => 1,
        ]);

        //Menu todo relacionado a Ventas
        $ventas = MenuItems::create([
            'title' => 'Ventas',
            'route' => 'ventas.list',
            'icon' => 'heroicon-o-check-circle',
            'permission_name' => 'ventas-list',
            'order' => 2,
        ]);

        //Submenu de ventas
        $ventasNueva = MenuItems::create([
            'title' => 'Nueva Venta',
            'route' => 'ventas.create',
            'icon' => 'heroicon-o-users',
            'permission_name' => 'ventas-create',
            'parent_id' => $ventas->id, 
            'order' => 1,
        ]);

        $ventasReporte = MenuItems::create([
            'title' => 'Reportes',
            'route' => 'ventas.report',
            'icon' => 'heroicon-o-users',
            'permission_name' => 'ventas-report', 
            'parent_id' => $ventas->id, 
            'order' => 2,
        ]);

        $ventasAnulacion = MenuItems::create([
            'title' => 'Anulacion',
            'route' => 'ventas.override',
            'icon' => 'heroicon-o-users',
            'permission_name' => 'ventas-override', 
            'parent_id' => $ventas->id, 
            'order' => 3,
        ]);

        $ventasBorrar = MenuItems::create([
            'title' => 'Borrar',
            'route' => 'ventas.delete',
            'icon' => 'heroicon-o-users',
            'permission_name' => 'ventas-delete', 
            'parent_id' => $ventas->id, 
            'order' => 4,
        ]);

        $ventasEnlaces = MenuItems::create([
            'title' => 'Enlaces',
            'route' => 'ventas.enlaces',
            'icon' => 'heroicon-o-users',
            'permission_name' => 'ventas-enlaces', 
            'parent_id' => $ventas->id, 
            'order' => 5,
        ]);

        $ventasNuevoCliente = MenuItems::create([
            'title' => 'Nuevo Cliente',
            'route' => 'ventas.create.client',
            'icon' => 'heroicon-o-users',
            'permission_name' => 'ventas-create-client', 
            'parent_id' => $ventas->id, 
            'order' => 6,
        ]);

        $ventasNuevoProducto = MenuItems::create([
            'title' => 'Nuevo Producto',
            'route' => 'ventas.create.product',
            'icon' => 'heroicon-o-users',
            'permission_name' => 'ventas-create-product', 
            'parent_id' => $ventas->id, 
            'order' => 7,
        ]);

        $ventasCierreCaja = MenuItems::create([
            'title' => 'Cieere Caja',
            'route' => 'ventas.close.caj',
            'icon' => 'heroicon-o-users',
            'permission_name' => 'ventas-close-caj', 
            'parent_id' => $ventas->id, 
            'order' => 8,
        ]);

        //Menu todo relacionado a Administracion
        $admin = MenuItems::create([
            'title' => 'Administracion',
            'route' => 'admin.list',
            'icon' => 'heroicon-o-check-circle',
            'permission_name' => 'admin-list',
            'order' => 1,
        ]);

        //Submenu de adminsitracion
        // $ventasNueva = MenuItems::create([
        //     'title' => 'Nueva Venta',
        //     'route' => 'ventas.create',
        //     'icon' => 'heroicon-o-users',
        //     'permission_name' => 'ventas-create',
        //     'parent_id' => $ventas->id, 
        //     'order' => 1,
        // ]);
    }
}
