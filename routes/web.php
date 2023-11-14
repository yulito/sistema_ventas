<?php

use Lib\Route;
use App\Controllers\SessionController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\AreaController;

// ---- todas las rutas
Route::get('/', [SessionController::class, 'index']);
Route::post('/', [SessionController::class, 'login']);

// ---- perfil administrador
Route::get('/gestion-usuario', [UserController::class, 'index']);
Route::post('/gestion-usuario', [UserController::class, 'store']);
Route::get('/usuarios', [UserController::class, 'show']);
Route::get('/editar-usuario/:nombre', [UserController::class, 'viewEdit']);
Route::post('/editar-usuario', [UserController::class, 'edit']);

Route::get('/gestion-productos', [ProductController::class, 'index']);


Route::get('/agregar-area', [AreaController::class, 'index']);
Route::post('/agregar-area', [AreaController::class, 'store']);
Route::get('/editar-area/:id', [AreaController::class, 'showEdit']);
Route::post('/editar-area', [AreaController::class, 'edit']);

// --------------------
Lib\Route::dispatch();