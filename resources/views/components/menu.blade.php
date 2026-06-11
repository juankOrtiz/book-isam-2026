<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-emerald-100 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('inicio') }}"
                    class="text-xl font-bold text-emerald-700 tracking-tight flex items-center gap-2">
                    <span class="bg-emerald-600 text-white p-1.5 rounded-lg text-sm">📚</span>
                    Book <span class="text-emerald-500">ISAM</span>
                </a>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('inicio') }}"
                    class="px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50 transition-colors duration-200">
                    Inicio
                </a>
                <a href="{{ route('usuarios.index') }}"
                    class="px-3 py-2 rounded-md text-sm font-medium text-slate-700 hover:text-emerald-700 hover:bg-emerald-50 transition-colors duration-200">
                    Usuarios
                </a>
            </div>
        </div>
    </div>
</nav>
