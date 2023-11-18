<?php

use Lib\Route;
use App\Controllers\SessionController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\AreaController;
use App\Controllers\CategoryController; 
use App\Controllers\SubcategoryController; 
use App\Controllers\BrandController;

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

//subcategoria
Route::get('/agregar-subcategoria', [SubcategoryController::class, 'index']);
Route::post('/agregar-subcategoria', [SubcategoryController::class, 'store']);
Route::get('/editar-subcategoria/:id', [SubcategoryController::class, 'showEdit']);
Route::post('/editar-subcategoria', [SubcategoryController::class, 'edit']);
//categoria
Route::get('/agregar-categoria', [CategoryController::class, 'index']);
Route::post('/agregar-categoria', [CategoryController::class, 'store']);
Route::get('/editar-categoria/:id', [CategoryController::class, 'showEdit']);
Route::post('/editar-categoria', [CategoryController::class, 'edit']);
//marca
Route::get('/agregar-marca', [BrandController::class, 'index']);
Route::post('/agregar-marca', [BrandController::class, 'store']);
Route::get('/editar-marca/:id', [BrandController::class, 'showEdit']);
Route::post('/editar-marca', [BrandController::class, 'edit']);
//area
Route::get('/agregar-area', [AreaController::class, 'index']);
Route::post('/agregar-area', [AreaController::class, 'store']);
Route::get('/editar-area/:id', [AreaController::class, 'showEdit']);
Route::post('/editar-area', [AreaController::class, 'edit']);

// --------------------
Lib\Route::dispatch();