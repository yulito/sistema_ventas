<?php

use Lib\Route;
use App\Controllers\SessionController;
use App\Controllers\UserController;
use App\Controllers\ProductController;

// ---- todas las rutas
Route::get('/', [SessionController::class, 'index']);
Route::post('/', [SessionController::class, 'login']);

// ---- perfil administrador
Route::get('/gestion-usuario', [UserController::class, 'index']);
Route::post('/gestion-usuario', [UserController::class, 'store']);
Route::get('/usuarios', [UserController::class, 'show']);

Route::get('/gestion-productos', [ProductController::class, 'adminProduct']);

// --------------------
Lib\Route::dispatch();