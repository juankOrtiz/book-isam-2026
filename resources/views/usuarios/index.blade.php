@extends('layouts.app')

@section('titulo', 'Lista de usuarios')

@section('contenido')
    <h1 class="text-2xl font-bold text-blue-700">Listado de usuarios</h1>

    @foreach ($usuarios as $usuario)
        <li>{{ $usuario["nombre"] }}</li>
    @endforeach
@endsection
