<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index() {
        $usuarios = [
            [
                'nombre' => 'Juan',
                'email' => 'juan@mail.com'
            ],
            [
                'nombre' => 'Pedro',
                'email' => 'pedro@mail.com'
            ],
            [
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
        // 2. A futuro: guardar en la BD
        // 3. Redirigir a la pagina index
        return redirect()
            ->route('usuarios.index')
            ->with('success', 'El usuario fue creado');
    }
}
