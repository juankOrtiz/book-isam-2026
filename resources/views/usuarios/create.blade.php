@extends('layouts.app')

@section('titulo', 'Crear Nuevo Usuario')

@section('contenido')
    <div class="mb-6">
        <a href="{{ route('usuarios.index') }}"
            class="inline-flex items-center text-sm font-medium text-emerald-600 hover:text-emerald-700 gap-1 group">
            <span class="transform group-hover:-translate-x-1 transition-transform duration-200">←</span>
            Volver al listado
        </a>
    </div>

    <div class="max-w-2xl mx-auto bg-white rounded-2xl border border-emerald-100 shadow-xs overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-900">Registrar nuevo usuario</h3>
            <p class="mt-1 text-sm text-slate-500">
                Introduce los datos para dar de alta al usuario en Book ISAM.
            </p>
        </div>

        <form action="{{ route('usuarios.store') }}" method="POST" class="p-6 space-y-6" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Nombre completo
                </label>
                <div class="relative">
                    <input type="text" name="nombre" id="nombre" placeholder="Ej. Juan Pérez"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-hidden focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all duration-200"
                        value="{{ old('nombre') }}">
                </div>
                @error('nombre')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Correo electrónico
                </label>
                <div class="relative">
                    <input type="email" name="email" id="email" placeholder="juan.perez@ejemplo.com"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-hidden focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all duration-200"
                        value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="avatar" class="block text-sm font-medium text-slate-700 mb-1.5">
                    Imagen de perfil (opcional)
                </label>
                <div class="relative">
                    <input type="file" name="avatar" id="avatar" placeholder="juan.perez@ejemplo.com"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-hidden focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all duration-200"
                        value="{{ old('avatar') }}" accept="image/*">
                </div>
                @error('avatar')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <span>⚠️</span> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('usuarios.index') }}"
                    class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium text-slate-600 bg-white hover:bg-slate-50 hover:text-slate-900 focus:outline-hidden transition-colors cursor-pointer">
                    Cancelar
                </a>

                <button type="submit"
                    class="px-4 py-2.5 border border-transparent rounded-xl shadow-xs text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors cursor-pointer">
                    Guardar Usuario
                </button>
            </div>
        </form>

    </div>
@endsection
