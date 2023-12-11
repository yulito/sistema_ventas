<?php

use Lib\Route;
use App\Controllers\SessionController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\AreaController;
use App\Controllers\CategoryController; 
use App\Controllers\SubcategoryController; 
use App\Controllers\BrandController;
use App\Controllers\LocationController;
use App\Controllers\OfficeController;

// ---- todas las rutas
Route::get('/', [SessionController::class, 'index']);
Route::post('/login', [SessionController::class, 'login']);
Route::get('/logout', [SessionController::class, 'logout']);

// ---- perfil administrador
Route::get('/gestion-usuario', [UserController::class, 'index']);
Route::post('/gestion-usuario', [UserController::class, 'store']);
Route::get('/usuarios', [UserController::class, 'show']);
Route::get('/editar-usuario/:nombre', [UserController::class, 'viewEdit']);
Route::post('/editar-usuario', [UserController::class, 'edit']);
//Productos
Route::get('/gestion-productos', [ProductController::class, 'index']);
Route::get('/agregar-productos', [ProductController::class, 'showAdd']);
Route::post('/agregar-productos', [ProductController::class, 'store']);
Route::get('/listar-productos/:prod', [ProductController::class, 'list']);
Route::get('/mostrar-producto/:id', [ProductController::class, 'show']);
Route::get('/editar-producto/:id', [ProductController::class, 'showEdit']);
Route::post('/editar-producto', [ProductController::class, 'edit']);
Route::get('/agregar-stock', [ProductController::class, 'showStock']);
Route::post('/agregar-stock', [ProductController::class, 'addStock']);
Route::get('/lotes', [ProductController::class, 'showBatch']);
Route::post('/lotes/:cod', [ProductController::class, 'listBatch']);

//subcategoria
Route::get('/agregar-subcategoria', [SubcategoryController::class, 'index']);
Route::post('/agregar-subcategoria', [SubcategoryController::class, 'store']);
Route::get('/editar-subcategoria/:id', [SubcategoryController::class, 'showEdit']);
Route::post('/editar-subcategoria', [SubcategoryController::class, 'edit']);
Route::get('/adquirir-sub/:id', [SubcategoryController::class, 'getOneType']);
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

//---- localidades/comunas   
Route::get('/gestion-ubicacion', [LocationController::class, 'index']);
Route::get('/agregar-locacion', [LocationController::class, 'showAdd']);
Route::post('/agregar-locacion', [LocationController::class, 'store']);
Route::get('/editar-locacion/:id', [LocationController::class, 'showEdit']);
Route::post('/editar-locacion', [LocationController::class, 'edit']);
//---- sucursal
Route::post('/gestion-sucursal', [OfficeController::class, 'store']);

// --------------------
Lib\Route::dispatch();