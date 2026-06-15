@extends('layouts.app')

@section('titulo', 'Lista de usuarios')

@section('contenido')
    <div class="md:flex md:items-center md:justify-between border-b border-slate-200 pb-5 mb-6">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl sm:truncate tracking-tight">
                Listado de usuarios
            </h1>
            <p class="mt-2 text-sm text-slate-500">
                Administra los usuarios de la plataforma y revisa sus listas de lectura.
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route('usuarios.create') }}"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl shadow-xs text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors cursor-pointer">
                Nuevo Usuario
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-white border border-emerald-200 rounded-xl shadow-xs flex items-start gap-3 animate-fade-in">
            <!-- Icono de Check / Éxito (Color Verde/Emerald) -->
            <div
                class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-600 flex items-center justify-center text-white text-xs font-bold shadow-xs">
                ✓
            </div>

            <!-- Contenido del Mensaje -->
            <div class="flex-1">
                <h4 class="text-sm font-bold text-emerald-900">
                    ¡Operación exitosa!
                </h4>
                <p class="mt-0.5 text-sm text-emerald-700/90 leading-relaxed">
                    {{ session('success') }}
                </p>
            </div>

            <!-- Botón para cerrar (Opcional, puramente estético o funcional si usas JS) -->
            <button type="button"
                class="text-emerald-400 hover:text-emerald-600 transition-colors cursor-pointer text-sm font-medium px-1"
                onclick="this.parentElement.remove()">
                ✕
            </button>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-emerald-100 shadow-xs overflow-hidden">
        <ul role="list" class="divide-y divide-slate-100">
            @foreach ($usuarios as $usuario)
                <li class="p-4 sm:px-6 hover:bg-emerald-50/40 transition-colors duration-150 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="p-2 rounded-sm bg-emerald-600 flex items-center justify-center text-white font-semibold text-sm">
                            {{ $usuario["nombre"] }}
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="/usuarios/1/edit">Editar</a>
                        <form action="{{ route('usuarios.destroy', 1) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Eliminar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
