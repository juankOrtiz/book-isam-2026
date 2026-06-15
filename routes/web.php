<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

/*Route::get('/usuarios', [UsuariosController::class, "index"])
    ->name('usuarios.index');

Route::get('/usuarios/crear', [UsuariosController::class, "create"])
    ->name('usuarios.create');

Route::post('/usuarios', [UsuariosController::class, "store"])
    ->name('usuarios.store');

Route::get('/usuarios/{id}', [UsuariosController::class, "show"])
    ->name('usuarios.show');

Route::get('/usuarios/{id}/edit', [UsuariosController::class, "edit"])
    ->name('usuarios.edit');

Route::put('/usuarios/{id}', [UsuariosController::class, "update"])
    ->name('usuarios.update');

Route::delete('/usuarios/{id}', [UsuariosController::class, "destroy"])
    ->name('usuarios.destroy');*/

Route::resource('usuarios', UsuariosController::class);
