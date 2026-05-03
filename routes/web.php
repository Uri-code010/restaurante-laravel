<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;

Route::get('/platillos', [PlatilloController::class, 'index']);
Route::get('/platillos/crear', [PlatilloController::class, 'create']);
Route::post('/platillos', [PlatilloController::class, 'store']);
Route::delete('/platillos/{id}', [PlatilloController::class, 'destroy']);
Route::get('/platillos/{id}/editar', [PlatilloController::class, 'edit']);
Route::put('/platillos/{id}', [PlatilloController::class, 'update']);
Route::resource('platillos', PlatilloController::class);