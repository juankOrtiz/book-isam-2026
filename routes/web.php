<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/usuarios', [UsuariosController::class, "index"])
    ->name('usuarios.index');

Route::get('/usuarios/crear', [UsuariosController::class, "create"])
    ->name('usuarios.create');

Route::post('/usuarios', [UsuariosController::class, "store"])
    ->name('usuarios.store');
