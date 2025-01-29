<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::prefix('ventas')->group(function () {
    // Lista de Ventas
    Volt::route('/', 'ventas.index')
        ->name('ventas.list')
        ->middleware('permission:ventas.list');

    // Crear Venta
    Volt::route('create', 'ventas.create')
        ->name('ventas.create')
        ->middleware('permission:ventas.create');

    // Lista de Productos
    Volt::route('product/list', 'ventas.product-list')
        ->name('ventas.product.list')
        ->middleware('permission:ventas.product.list');

    // Reportes de Ventas
    Volt::route('report', 'ventas.report')
        ->name('ventas.report')
        ->middleware('permission:ventas.report');

    // Anulación de Ventas
    Volt::route('override', 'ventas.override')
        ->name('ventas.override')
        ->middleware('permission:ventas.override');

    // Eliminar Ventas
    Volt::route('delete', 'ventas.delete')
        ->name('ventas.delete')
        ->middleware('permission:ventas.delete');

    // Enlaces
    Volt::route('enlaces', 'ventas.enlaces')
        ->name('ventas.enlaces')
        ->middleware('permission:ventas.enlaces');

    // Crear Cliente
    Volt::route('create/client', 'ventas.create-client')
        ->name('ventas.create.client')
        ->middleware('permission:ventas.create.client');

    // Crear Producto
    Volt::route('create/product', 'ventas.create-product')
        ->name('ventas.create.product')
        ->middleware('permission:ventas.create.product');

    // Cierre de Caja
    Volt::route('close/caj', 'ventas.close-caj')
        ->name('ventas.close.cash')
        ->middleware(['permission:ventas.close.caj']);
});


Route::prefix('admin')->group(function () {
    // Lista de Administradores
    Volt::route('list', 'admin.index')
        ->name('admin.list')
        ->middleware(['permission:admin.list']);

    // Gestión de roles
    Volt::route('roles/list', 'admin.roles')
        ->name('admin.roles')
        ->middleware(['permission:admin.manage-roles']);

    Volt::route('roles/detail', 'admin.roles.detail')
        ->name('admin.roles.detail')
        ->middleware(['permission:admin.roles.detail']);

    // Gestión de usuarios
    Volt::route('users/list', 'admin.users.list')
        ->name('admin.users')
        ->middleware(['permission:admin.users.list']);
});
