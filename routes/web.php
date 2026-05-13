<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\PedidoController;

// use App\Http\Controllers\CarritoController; // Lo descomentaremos cuando hagamos el carrito
// ========================================================
// 1. ZONA DE CLIENTES (Pública - Menú y Pedidos)
// ========================================================

// Esta es la nueva ruta para tu vista del cliente (la que no tiene botones de borrar/editar)
Route::get('/menu', [PlatilloController::class, 'menuPublico'])->name('menu.cliente');

// Estas rutas manejarán la lógica de ordenar (las crearemos en el siguiente paso)
Route::post('/pedido/agregar/{id}', [PedidoController::class, 'agregar'])->name('pedido.agregar');
Route::get('/pedido', [PedidoController::class, 'ver'])->name('pedido.ver');
Route::get('/ticket', [PedidoController::class, 'ticket'])->name('pedido.ticket');


// ========================================================
// 2. ZONA DE ADMINISTRACIÓN (Privada - CRUD)
// ========================================================
// Mantenemos tus rutas originales para no romper los formularios que ya hiciste.
// Cuando tu compañero termine el Login, él agrupará estas rutas bajo una regla de seguridad.

Route::get('/platillos', [PlatilloController::class, 'index'])->name('platillos.index');
Route::get('/platillos/crear', [PlatilloController::class, 'create'])->name('platillos.create');
Route::post('/platillos', [PlatilloController::class, 'store'])->name('platillos.store');
Route::get('/platillos/{id}/editar', [PlatilloController::class, 'edit'])->name('platillos.edit');
Route::put('/platillos/{id}', [PlatilloController::class, 'update'])->name('platillos.update');
Route::delete('/platillos/{id}', [PlatilloController::class, 'destroy'])->name('platillos.destroy');
