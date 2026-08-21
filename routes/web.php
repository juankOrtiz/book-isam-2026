<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ConsultaAvanzadaController;
use App\Models\ListaLectura;
use App\Models\Libro;

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

Route::prefix('pruebas')->controller(ConsultaAvanzadaController::class)->group(function () {
    Route::get('/libros-leidos', 'librosLeidos');
    Route::get('/usuarios-leyendo', 'usuariosLeyendo');
    Route::get('/estadisticas-listas', 'estadisticasListas');
    Route::get('/ultima-lista', 'ultimaListaUsuario');
    Route::get('/busqueda-dinamica', 'busquedaDinamica');
    Route::get('/reporte-autores', 'reporteAutores');
});

Route::get('/prueba-scope', function() {
    $listas = ListaLectura::delUsuario(1)
        ->get();
    dd($listas);
});

Route::get('/prueba-libros', function() {
    $libros = Libro::all();
    //$libros = Libro::onlyTrashed()->get();

    dd($libros);
});
