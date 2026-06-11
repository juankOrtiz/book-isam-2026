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
}
