@extends('layouts.app')

@section('titulo', 'Mis Listas de Lectura')

@section('contenido')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-emerald-950">Mis Listas de Lectura</h1>
                <p class="text-emerald-700 text-sm mt-1">Organiza tus libros pendientes, en curso y terminados.</p>
            </div>
            <a href="{{ route('listas.create') }}"
                class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                + Nueva Lista
            </a>
        </div>

        @if (session('status'))
            <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($listas->isEmpty())
            <div class="p-8 text-center bg-white rounded-xl border border-emerald-100 shadow-sm">
                <p class="text-slate-600 mb-4">Aún no has creado ninguna lista de lectura.</p>
                <a href="{{ route('listas.create') }}" class="text-emerald-700 hover:underline font-medium">Crear mi primera
                    lista →</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($listas as $lista)
                    <div
                        class="bg-white rounded-xl border border-emerald-100 p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                        <div>
                            {{-- Título como enlace al detalle --}}
                            <h2 class="text-xl font-bold text-slate-800 mb-2">
                                <a href="{{ route('listas.show', $lista) }}"
                                    class="hover:text-emerald-700 hover:underline transition-colors">
                                    {{ $lista->nombre }}
                                </a>
                            </h2>
                            <p class="text-slate-600 text-sm mb-4 line-clamp-3">
                                {{ $lista->descripcion ?? 'Sin descripción.' }}
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>{{ $lista->libros_count }} {{ Str::plural('libro', $lista->libros_count) }}</span>
                            <a href="{{ route('listas.show', $lista) }}" class="text-emerald-700 font-medium hover:underline">
                                Ver detalles →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
