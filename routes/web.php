<?php

use Lib\Route;
use App\Controllers\SessionController;

// ---- todas las rutas
Route::get('/', [SessionController::class, 'index']);
Route::post('/', [SessionController::class, 'login']);


// --------------------

Lib\Route::dispatch();