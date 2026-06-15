@extends('layouts.app')

@section('titulo', 'Perfil de ' . $usuario['nombre'])

@section('contenido')
    <div class="mb-6">
        <a href="/usuarios"
            class="inline-flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-700 gap-1 group">
            <span class="transform group-hover:-translate-x-1 transition-transform duration-200">←</span>
            Volver al listado
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-emerald-100 shadow-xs p-6 text-center sticky top-24">
                <div
                    class="w-20 h-20 mx-auto rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold text-3xl shadow-md mb-4">
                    {{ substr($usuario['nombre'], 0, 1) }}
                </div>

                <h2 class="text-xl font-bold text-slate-900 tracking-tight">{{ $usuario['nombre'] }}</h2>
                <p class="text-sm text-slate-500 mb-6">{{ $usuario['email'] }}</p>

                <hr class="border-slate-100 my-4">

                <div class="grid grid-cols-2 gap-2 text-center">
                    <div class="bg-emerald-50/50 p-3 rounded-xl border border-emerald-100/50">
                        <span class="block text-2xl font-bold text-emerald-700">
                            {{ count($usuario['libros_pendientes'] ?? []) }}
                        </span>
                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Pendientes</span>
                    </div>
                    <div class="bg-blue-50/50 p-3 rounded-xl border border-blue-100/50">
                        <span class="block text-2xl font-bold text-blue-700">
                            {{ count($usuario['libros_leidos'] ?? []) }}
                        </span>
                        <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Leídos</span>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="/usuarios/{{ $usuario['id'] }}/edit"
                        class="w-full inline-flex justify-center items-center px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 transition-colors">
                        Editar Perfil
                    </a>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">

            <div class="bg-white rounded-2xl border border-emerald-100 shadow-xs overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-900 flex items-center gap-2">
                        <span class="text-amber-500">⏳</span> Lista de Pendientes
                    </h3>
                    <button
                        class="text-xs font-bold text-emerald-600 hover:text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg transition-colors cursor-pointer">
                        + Añadir Libro
                    </button>
                </div>

                @if(empty($usuario['libros_pendientes']))
                    <div class="p-8 text-center text-slate-400 text-sm">
                        No hay libros pendientes en la lista.
                    </div>
                @else
                    <ul class="divide-y divide-slate-100">
                        @foreach ($usuario['libros_pendientes'] as $libro)
                            <li class="p-4 px-6 hover:bg-slate-50/50 flex items-center justify-between transition-colors">
                                <div class="flex items-center gap-3">
                                    <span class="text-xl">📖</span>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">{{ $libro['titulo'] }}</p>
                                        <p class="text-xs text-slate-400">Autor: {{ $libro['autor'] }}</p>
                                    </div>
                                </div>
                                <button
                                    class="text-xs font-medium text-emerald-700 bg-emerald-100/80 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors cursor-pointer">
                                    ✓ Leído
                                </button>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="bg-white rounded-2xl border border-emerald-100 shadow-xs overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-900 flex items-center gap-2">
                        <span class="text-emerald-600">✅</span> Libros Leídos y Valoraciones
                    </h3>
                </div>

                @if(empty($usuario['libros_leidos']))
                    <div class="p-8 text-center text-slate-400 text-sm">
                        Este usuario aún no ha calificado ningún libro.
                    </div>
                @else
                    <ul class="divide-y divide-slate-100">
                        @foreach ($usuario['libros_leidos'] as $libro)
                            <li class="p-4 px-6 hover:bg-slate-50/50 flex items-center justify-between transition-colors">
                                <div class="flex items-center gap-3">
                                    <span class="text-xl">📕</span>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">{{ $libro['titulo'] }}</p>
                                        <p class="text-xs text-slate-400">Leído el: {{ $libro['fecha_lectura'] ?? 'Recientemente' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-1 bg-amber-50 border border-amber-100 px-2.5 py-1 rounded-xl">
                                    <span class="text-amber-500 text-xs">★</span>
                                    <span class="text-xs font-bold text-amber-800">{{ $libro['puntaje'] }}/5</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
@endsection
