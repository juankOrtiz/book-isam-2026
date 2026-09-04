<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ConsultaAvanzadaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListaLecturaController;
use App\Models\ListaLectura;
use App\Models\Libro;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('inicio');

// Parte privada de la app: requiere iniciar sesion
Route::middleware('auth')->group(function () {
    // Ruta del dashboard para redirigir usuarios logueados
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Ruta para cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('usuarios', UsuariosController::class);

    Route::get('/listas', [ListaLecturaController::class, 'index'])
        ->name('listas.index');
    Route::get('/listas/crear', [ListaLecturaController::class, 'create'])
        ->name('listas.create');
    Route::post('/listas', [ListaLecturaController::class, 'store'])
        ->name('listas.store');
    Route::get('/listas/{lista}', [ListaLecturaController::class, 'show'])
        ->name('listas.show');
    Route::post('/listas/{lista}/libros', [ListaLecturaController::class, 'agregarLibro'])
        ->name('listas.agregar-libro');

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
});

// Ruta para mostrar el formulario de login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Ruta para procesar el intento de login
Route::post('/login', [AuthController::class, 'storeLogin'])
    ->name('login.store');
