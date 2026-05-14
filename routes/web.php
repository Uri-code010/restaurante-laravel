<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\OrdenController;

// ========================================================
// 1. RUTAS PÚBLICAS Y DE AUTENTICACIÓN
// ========================================================
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ========================================================
// 2. ZONA DE CLIENTES (Usuarios que iniciaron sesión para pedir)
// ========================================================
Route::middleware(['auth', 'rol:cliente'])->group(function () {

    // Tu Menú visual (Corregido para que use tu función menuPublico)
    Route::get('/menu', [PlatilloController::class, 'menuPublico'])->name('menu');

    // Tu sistema de carrito/pedido en memoria temporal
    Route::post('/pedido/agregar/{id}', [PedidoController::class, 'agregar'])->name('pedido.agregar');
    Route::get('/pedido', [PedidoController::class, 'ver'])->name('pedido.ver');
    Route::get('/ticket', [PedidoController::class, 'ticket'])->name('pedido.ticket');

    // Las rutas de tu compañero para guardar definitivamente en la base de datos
    Route::post('/orden', [OrdenController::class, 'store'])->name('orden.store');
    Route::get('/mis-ordenes', [OrdenController::class, 'misOrdenes'])->name('orden.mis');
});


// ========================================================
// 3. ZONA DE STAFF / COCINERO (Administración)
// ========================================================
Route::middleware(['auth', 'rol:cocinero'])->group(function () {

    // Tu CRUD de Platillos (¡Ahora sí está protegido bajo candado!)
    Route::get('/platillos', [PlatilloController::class, 'index'])->name('platillos.index');
    Route::get('/platillos/crear', [PlatilloController::class, 'create'])->name('platillos.create');
    Route::post('/platillos', [PlatilloController::class, 'store'])->name('platillos.store');
    Route::get('/platillos/{id}/editar', [PlatilloController::class, 'edit'])->name('platillos.edit');
    Route::put('/platillos/{id}', [PlatilloController::class, 'update'])->name('platillos.update');
    Route::delete('/platillos/{id}', [PlatilloController::class, 'destroy'])->name('platillos.destroy');

    // Las rutas de tu compañero para gestionar las comandas que van llegando
    Route::get('/ordenes', [OrdenController::class, 'index'])->name('orden.index');
    Route::post('/orden/{id}/estado', [OrdenController::class, 'cambiarEstado'])->name('orden.estado');
    Route::get('/orden/{id}', [OrdenController::class, 'show'])->name('orden.show');
});
