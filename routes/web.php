<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventario\InventarioController;
use App\Http\Controllers\Pedido\PedidoController;
use App\Models\Inventario;

Route::get('/', function () {
    return view('welcome');
});

// rutas de los controladores 
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
->resource('inventario',InventarioController::class)
->names('inventario');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
->resource('pedido',PedidoController::class)
->names('pedido');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
