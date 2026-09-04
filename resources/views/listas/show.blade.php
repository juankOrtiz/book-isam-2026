@extends('layouts.app')

@section('titulo', $lista->nombre)

@section('contenido')
    <div class="space-y-6 max-w-5xl mx-auto">

        {{-- Cabecera con título y botón de acción --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-emerald-100 pb-4">
            <div>
                <a href="{{ route('listas.index') }}"
                    class="text-xs font-semibold text-emerald-700 hover:underline mb-2 inline-block">
                    ← Volver a mis listas
                </a>
                <h1 class="text-3xl font-bold text-emerald-950">{{ $lista->nombre }}</h1>
                @if ($lista->descripcion)
                    <p class="text-slate-600 text-sm mt-1">{{ $lista->descripcion }}</p>
                @endif
            </div>

            <div class="flex items-center space-x-3">
                <button onclick="abrirModal()" type="button"
                    class="inline-flex items-center px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                    + Agregar Libro
                </button>
            </div>
        </div>

        @if (session('status'))
            <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        {{-- Tabla / Listado de Libros --}}
        @if ($lista->libros->isEmpty())
            <div class="bg-white rounded-xl border border-emerald-100 p-8 text-center shadow-sm">
                <p class="text-slate-600 mb-3">Esta lista no contiene libros aún.</p>
                <button onclick="abrirModal()" type="button" class="text-emerald-700 font-medium hover:underline text-sm">
                    + Agregar el primer libro
                </button>
            </div>
        @else
            <div class="bg-white rounded-xl border border-emerald-100 shadow-sm overflow-hidden">
                <table class="w-full text-left text-sm text-slate-700">
                    <thead class="bg-emerald-50/50 text-slate-900 border-b border-emerald-100">
                        <tr>
                            <th class="p-4 font-semibold">Libro</th>
                            <th class="p-4 font-semibold">Autor</th>
                            <th class="p-4 font-semibold">Estado</th>
                            <th class="p-4 font-semibold">Puntaje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($lista->libros as $libro)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="p-4 font-medium text-slate-900">{{ $libro->nombre }}</td>
                                <td class="p-4 text-slate-600">{{ $libro->autor }}</td>
                                <td class="p-4">
                                    @php
                                        $colores = [
                                            'completado' => 'bg-emerald-100 text-emerald-800',
                                            'leyendo' => 'bg-amber-100 text-amber-800',
                                            'pendiente' => 'bg-slate-100 text-slate-800',
                                        ];
                                        $estado = $libro->pivot->estado;
                                    @endphp
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-full capitalize {{ $colores[$estado] ?? 'bg-slate-100 text-slate-800' }}">
                                        {{ $estado }}
                                    </span>
                                </td>
                                <td class="p-4 font-semibold text-amber-600">
                                    {{ $libro->pivot->puntaje ? $libro->pivot->puntaje . ' / 5 ⭐' : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- MODAL PARA AGREGAR LIBRO (Oculto por defecto con 'hidden') --}}
        <div id="modal-agregar-libro"
            class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
            <div id="modal-contenido"
                class="bg-white rounded-xl shadow-xl border border-emerald-100 w-full max-w-lg overflow-hidden">

                <div class="flex justify-between items-center px-6 py-4 border-b border-slate-100">
                    <h3 class="font-bold text-slate-800 text-lg">Agregar Libro a la Lista</h3>
                    <button onclick="cerrarModal()" type="button"
                        class="text-slate-400 hover:text-slate-600 font-bold text-xl">&times;</button>
                </div>

                <form action="{{ route('listas.agregar-libro', $lista) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <input type="hidden" name="modo" id="input-modo" value="existente">

                    {{-- Selector de Modo (Pestañas) --}}
                    <div class="flex border-b border-slate-200">
                        <button type="button" id="btn-tab-existente" onclick="cambiarModo('existente')"
                            class="flex-1 py-2 text-center text-sm font-semibold border-emerald-600 text-emerald-700 border-b-2 transition-colors">
                            Seleccionar Existente
                        </button>
                        <button type="button" id="btn-tab-nuevo" onclick="cambiarModo('nuevo')"
                            class="flex-1 py-2 text-center text-sm text-slate-500 hover:text-slate-700 transition-colors">
                            Crear Nuevo Libro
                        </button>
                    </div>

                    {{-- Opción A: Libro Existente --}}
                    <div id="seccion-existente" class="space-y-4">
                        <div>
                            <label for="libro_id" class="block text-sm font-medium text-slate-700 mb-1">Selecciona un libro
                                *</label>
                            @if($librosDisponibles->isEmpty())
                                <p class="text-xs text-amber-600 bg-amber-50 p-2.5 rounded-lg border border-amber-200">
                                    No hay libros registrados disponibles para agregar. Utiliza la pestaña "Crear Nuevo Libro".
                                </p>
                            @else
                                <select name="libro_id" id="libro_id"
                                    class="w-full rounded-lg border-slate-300 border p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    <option value="">-- Selecciona un libro --</option>
                                    @foreach($librosDisponibles as $libro)
                                        <option value="{{ $libro->id }}">{{ $libro->nombre }} ({{ $libro->autor }})</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>

                    {{-- Opción B: Crear Nuevo Libro --}}
                    <div id="seccion-nuevo" class="hidden space-y-3">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">Título del Libro
                                *</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Ej: Cien años de soledad"
                                class="w-full rounded-lg border-slate-300 border p-2 text-sm focus:border-emerald-500">
                        </div>
                        <div>
                            <label for="autor" class="block text-sm font-medium text-slate-700 mb-1">Autor *</label>
                            <input type="text" name="autor" id="autor" placeholder="Ej: Gabriel García Márquez"
                                class="w-full rounded-lg border-slate-300 border p-2 text-sm focus:border-emerald-500">
                        </div>
                        <div>
                            <label for="resumen" class="block text-sm font-medium text-slate-700 mb-1">Resumen
                                (opcional)</label>
                            <textarea name="resumen" id="resumen" rows="2" placeholder="Breve descripción del libro..."
                                class="w-full rounded-lg border-slate-300 border p-2 text-sm focus:border-emerald-500"></textarea>
                        </div>
                    </div>

                    <hr class="border-slate-100 my-2">

                    {{-- Datos del Pivot (Comunes a ambos modos) --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="estado" class="block text-sm font-medium text-slate-700 mb-1">Estado *</label>
                            <select name="estado" id="estado"
                                class="w-full rounded-lg border-slate-300 border p-2.5 text-sm focus:border-emerald-500">
                                <option value="pendiente">Pendiente</option>
                                <option value="leyendo">Leyendo</option>
                                <option value="completado">Completado</option>
                            </select>
                        </div>
                        <div>
                            <label for="puntaje" class="block text-sm font-medium text-slate-700 mb-1">Puntaje (1-5)</label>
                            <select name="puntaje" id="puntaje"
                                class="w-full rounded-lg border-slate-300 border p-2.5 text-sm focus:border-emerald-500">
                                <option value="">Sin puntaje</option>
                                <option value="1">1 ⭐</option>
                                <option value="2">2 ⭐</option>
                                <option value="3">3 ⭐</option>
                                <option value="4">4 ⭐</option>
                                <option value="5">5 ⭐</option>
                            </select>
                        </div>
                    </div>

                    {{-- Botones del Modal --}}
                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <button onclick="cerrarModal()" type="button"
                            class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-50 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-sm font-medium shadow-sm transition-colors">
                            Guardar Libro
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT NATIVO --}}
    <script>
        function abrirModal() {
            document.getElementById('modal-agregar-libro').classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modal-agregar-libro').classList.add('hidden');
        }

        function cambiarModo(modo) {
            const inputModo = document.getElementById('input-modo');
            const seccionExistente = document.getElementById('seccion-existente');
            const seccionNuevo = document.getElementById('seccion-nuevo');
            const btnExistente = document.getElementById('btn-tab-existente');
            const btnNuevo = document.getElementById('btn-tab-nuevo');

            inputModo.value = modo;

            if (modo === 'existente') {
                seccionExistente.classList.remove('hidden');
                seccionNuevo.classList.add('hidden');

                btnExistente.className = "flex-1 py-2 text-center text-sm font-semibold border-emerald-600 text-emerald-700 border-b-2 transition-colors";
                btnNuevo.className = "flex-1 py-2 text-center text-sm text-slate-500 hover:text-slate-700 transition-colors";
            } else {
                seccionExistente.classList.add('hidden');
                seccionNuevo.classList.remove('hidden');

                btnNuevo.className = "flex-1 py-2 text-center text-sm font-semibold border-emerald-600 text-emerald-700 border-b-2 transition-colors";
                btnExistente.className = "flex-1 py-2 text-center text-sm text-slate-500 hover:text-slate-700 transition-colors";
            }
        }

        // Cerrar el modal al hacer clic fuera del contenido
        document.getElementById('modal-agregar-libro').addEventListener('click', function (e) {
            if (e.target === this) {
                cerrarModal();
            }
        });
    </script>
@endsection
