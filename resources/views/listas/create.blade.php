@extends('layouts.app')

@section('titulo', 'Crear Lista de Lectura')

@section('contenido')
    <div class="max-w-2xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-emerald-950">Nueva Lista de Lectura</h1>
            <p class="text-emerald-700 text-sm mt-1">Crea una categoría para agrupar tus lecturas.</p>
        </div>

        <div class="bg-white rounded-xl border border-emerald-100 p-6 shadow-sm">
            <form action="{{ route('listas.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">Nombre de la lista *</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                        placeholder="Ej: Favoritos 2026, Libros de Ciencia Ficción..."
                        class="w-full rounded-lg border-slate-300 border p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500 @error('nombre') border-red-500 @enderror">
                    @error('nombre')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="descripcion" class="block text-sm font-medium text-slate-700 mb-1">Descripción
                        (opcional)</label>
                    <textarea name="descripcion" id="descripcion" rows="4" placeholder="¿De qué trata esta lista?"
                        class="w-full rounded-lg border-slate-300 border p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('listas.index') }}"
                        class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-sm font-medium shadow-sm transition-colors">
                        Guardar Lista
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
