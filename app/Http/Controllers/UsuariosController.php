<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UsuariosController extends Controller
{
    public function index() {
        Gate::authorize('ver usuarios');

        $usuarios = User::paginate(5);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create() {
        Gate::authorize('crear usuarios');

        return view('usuarios.create');
    }

    public function store(StoreUsuarioRequest $request) {
        Gate::authorize('crear usuarios');
        // 1. Validar los datos (en StoreUsuarioRequest)
        // 1.5) Procesar y guardar la imagen de perfil
        /*if($request->hasFile('avatar')) {
            $request->file('avatar')->storeAs('avatars', 'usuario_' . time() . '.jpg', 'public');
        }*/
        // 2. Guardar en la BD
        User::create([
            'name' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        // 3. Redirigir a la pagina index
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario fue creado');
    }

    public function show(int $id) {
        Gate::authorize('ver usuarios');

        $usuario = User::with('listasLectura.libros')->findOrFail($id);

        $todosLosLibros = $usuario->listasLectura->flatMap(function ($lista) {
            return $lista->libros;
        });

        // Separar los libros segun su estado
        $librosPendientes = $todosLosLibros->where('pivot.estado', 'pendiente');
        $librosLeidos = $todosLosLibros->where('pivot.estado', 'completado');

        return view('usuarios.show', compact('usuario', 'librosPendientes', 'librosLeidos'));
    }

    public function edit(int $id) {
        Gate::authorize('editar usuarios');

        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(StoreUsuarioRequest $request, int $id) {
        Gate::authorize('editar usuarios');

        // Actualizar en la BD
        User::where('id', $id)
            ->update([
                'name' => $request->input('nombre'),
                'email' => $request->input('email'),
            ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario fue actualizado');
    }

    public function destroy(int $id) {
        Gate::authorize('eliminar usuarios');

        // Eliminar de la BD
        User::destroy($id);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario fue eliminado');
    }
}
