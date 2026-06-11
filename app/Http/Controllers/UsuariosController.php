<?php

namespace App\Http\Controllers;

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

    public function store(Request $request) {
        // A futuro: guardar en la BD
        return redirect()->route('usuarios.index');
    }
}
