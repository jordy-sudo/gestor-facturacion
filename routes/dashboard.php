<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Livewire\Volt\Volt;

Route::prefix('ventas')->group(function () {
    // Lista de Ventas
    Volt::route('/', 'ventas.index')
        ->name('ventas.list')
        ->middleware('permission:ventas-list2');

    // Crear Venta
    Volt::route('create', 'ventas.create')
        ->name('ventas.create')
        ->middleware('permission:ventas-create');

    // Lista de Productos
    Volt::route('product/list', 'ventas.product-list')
        ->name('ventas.product.list')
        ->middleware('permission:ventas-product-list');

    // Reportes de Ventas
    Volt::route('report', 'ventas.report')
        ->name('ventas.report')
        ->middleware('permission:ventas-report');

    // Anulación de Ventas
    Volt::route('override', 'ventas.override')
        ->name('ventas.override')
        ->middleware('permission:ventas-override');

    // Eliminar Ventas
    Volt::route('delete', 'ventas.delete')
        ->name('ventas.delete')
        ->middleware('permission:ventas-delete');

    // Enlaces
    Volt::route('enlaces', 'ventas.enlaces')
        ->name('ventas.enlaces')
        ->middleware('permission:ventas-enlaces');

    // Crear Cliente
    Volt::route('create/client', 'ventas.create-client')
        ->name('ventas.create.client')
        ->middleware('permission:ventas-create-client');

    // Crear Producto
    Volt::route('create/product', 'ventas.create-product')
        ->name('ventas.create.product')
        ->middleware('permission:ventas-create-product');

    // Cierre de Caja
    Volt::route('close/caj', 'ventas.close-caj')
        ->name('ventas.close.caj')
        ->middleware('permission:ventas-close-caj');
});


Route::prefix('admin')->group(function () {
    // Ruta para 'ventas/list'
    Volt::route('list', 'admin.index')->name('admin.list');
});