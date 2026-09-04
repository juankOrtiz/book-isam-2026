<?php

namespace App\Http\Controllers;

use App\Models\ListaLectura;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ListaLecturaController extends Controller
{
    // Listar únicamente las listas del usuario autenticado
    public function index()
    {
        $listas = ListaLectura::delUsuario(Auth::id())
            ->withCount('libros')
            ->latest()
            ->get();

        return view('listas.index', compact('listas'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('listas.create');
    }

    // Guardar la lista en BD asociada al usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        $request->user()->listasLectura()->create($validated);

        return redirect()->route('listas.index')
            ->with('status', 'Lista de lectura creada con éxito.');
    }

    // Mostrar el detalle de una lista de lectura y sus libros
    public function show(ListaLectura $lista)
    {
        Gate::authorize('view', $lista);

        $lista->load('libros');

        // Obtenemos los libros disponibles que aún NO han sido agregados a esta lista
        $librosDisponibles = Libro::whereNotIn('id', $lista->libros->pluck('id'))->get();

        return view('listas.show', compact('lista', 'librosDisponibles'));
    }

    public function agregarLibro(Request $request, ListaLectura $lista)
    {
        Gate::authorize('update', $lista);

        // Se valida el modo de ingreso: 'existente' o 'nuevo'
        $request->validate([
            'modo' => 'required|in:existente,nuevo',
            'estado' => 'required|in:pendiente,leyendo,completado',
            'puntaje' => 'nullable|integer|min:1|max:5',
        ]);

        if ($request->modo === 'existente') {
            $request->validate([
                'libro_id' => 'required|exists:libros,id',
            ]);

            $libroId = $request->libro_id;
        } else {
            $request->validate([
                'nombre' => 'required|string|max:150',
                'autor' => 'required|string|max:255',
                'resumen' => 'nullable|string',
            ]);

            // Se crea el libro en el catálogo general
            $nuevoLibro = Libro::create([
                'nombre' => $request->nombre,
                'autor' => $request->autor,
                'resumen' => $request->resumen,
            ]);

            $libroId = $nuevoLibro->id;
        }

        // Se conecta el libro con la lista guardando el estado y el puntaje en la tabla pivote
        $lista->libros()->attach($libroId, [
            'estado' => $request->estado,
            'puntaje' => $request->puntaje,
        ]);

        return redirect()->route('listas.show', $lista)
            ->with('status', 'Libro agregado a la lista exitosamente.');
    }
}
