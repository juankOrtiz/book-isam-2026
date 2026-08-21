<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function index() {
        $usuarios = User::paginate(5);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create() {
        return view('usuarios.create');
    }

    public function store(StoreUsuarioRequest $request) {
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
        $usuario = User::findOrFail($id);

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(StoreUsuarioRequest $request, int $id) {
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
        // Eliminar de la BD
        User::destroy($id);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario fue eliminado');
    }
}
