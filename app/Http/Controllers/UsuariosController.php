<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index() {
        $usuarios = [
            [
                'id' => 1,
                'nombre' => 'Juan',
                'email' => 'juan@mail.com'
            ],
            [
                'id' => 2,
                'nombre' => 'Pedro',
                'email' => 'pedro@mail.com',
                'avatar' => 'usuario_1781537702.jpg'
            ],
            [
                'id' => 3,
                'nombre' => 'Natalia',
                'email' => 'natalia@mail.com'
            ],
        ];
        return view('usuarios.index', compact('usuarios'));
    }

    public function create() {
        return view('usuarios.create');
    }

    public function store(StoreUsuarioRequest $request) {
        // 1. Validar los datos (en StoreUsuarioRequest)
        // 1.5) Procesar y guardar la imagen de perfil
        if($request->hasFile('avatar')) {
            $request->file('avatar')->storeAs('avatars', 'usuario_' . time() . '.jpg', 'public');
        }
        // 2. A futuro: guardar en la BD
        // 3. Redirigir a la pagina index
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario fue creado');
    }

    public function show(int $id) {
        /*if($id < 1 || $id > 3) {
            abort(404);
        }*/
        $usuarios = [
            [
                'id' => 1,
                'nombre' => 'Juan',
                'email' => 'juan@mail.com'
            ],
            [
                'id' => 2,
                'nombre' => 'Pedro',
                'email' => 'pedro@mail.com',
                'avatar' => 'usuario_1781537702.jpg'
            ],
            [
                'id' => 3,
                'nombre' => 'Natalia',
                'email' => 'natalia@mail.com'
            ],
        ];
        $usuario = $usuarios[$id - 1];
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(int $id) {
        $usuarios = [
            [
                'id' => 1,
                'nombre' => 'Juan',
                'email' => 'juan@mail.com'
            ],
            [
                'id' => 2,
                'nombre' => 'Pedro',
                'email' => 'pedro@mail.com'
            ],
            [
                'id' => 3,
                'nombre' => 'Natalia',
                'email' => 'natalia@mail.com'
            ],
        ];
        $usuario = $usuarios[$id - 1];

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(StoreUsuarioRequest $request, int $id) {
        // TODO: a futuro, actualizar en la BD
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario fue actualizado');
    }

    public function destroy(int $id) {
        // TODO: a futuro, eliminar de la BD
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario fue eliminado');
    }
}
