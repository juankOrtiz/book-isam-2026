<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/usuarios-sistema', [UsuariosController::class, "index"])
    ->name('usuarios.index');
