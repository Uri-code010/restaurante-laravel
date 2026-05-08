<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\OrdenController;

// Página inicial → redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Registro
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Cliente
Route::middleware(['auth','rol:cliente'])->group(function(){
    Route::get('/menu', [PlatilloController::class,'index'])->name('menu');
    Route::post('/orden', [OrdenController::class,'store'])->name('orden.store');
    Route::get('/mis-ordenes', [OrdenController::class,'misOrdenes'])->name('orden.mis');
});

// Cocinero
Route::middleware(['auth','rol:cocinero'])->group(function(){
    Route::get('/ordenes', [OrdenController::class,'index'])->name('orden.index');
    Route::post('/orden/{id}/estado', [OrdenController::class,'cambiarEstado'])->name('orden.estado');
    Route::get('/orden/{id}', [OrdenController::class,'show'])->name('orden.show');
});
