<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - NombreDeTuApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full antialiased font-sans text-slate-900">

    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2">

        <div class="hidden md:flex flex-col justify-between bg-slate-900 p-12 text-white relative overflow-hidden">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl"></div>


            <div class="relative z-10 my-auto">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">
                    NombreDeTuApp
                </h1>
                <p class="mt-4 text-slate-400 text-lg max-w-md leading-relaxed">
                    Gestiona usuarios, revisa sus listas de lectura y administra la plataforma desde un solo lugar.
                </p>
            </div>

        </div>

        <div class="flex flex-col justify-center items-center p-6 sm:p-12 bg-slate-50">
            <div class="w-full max-w-md space-y-8">

                <div class="md:hidden text-center">
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">NombreDeTuApp</h1>
                    <p class="mt-2 text-sm text-slate-500">Inicia sesión en tu cuenta para continuar</p>
                </div>

                <div class="border-b border-slate-200 pb-5">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        ¡Bienvenido de nuevo!
                    </h2>
                    <p class="mt-2 text-sm text-slate-500">
                        Ingresa tus credenciales para acceder al panel.
                    </p>
                </div>

                @if(session('success'))
                    <div class="p-4 bg-white border border-emerald-200 rounded-xl shadow-xs flex items-start gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-600 flex items-center justify-center text-white text-xs font-bold shadow-xs">
                            ✓
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-emerald-900">¡Operación exitosa!</h4>
                            <p class="mt-0.5 text-sm text-emerald-700/90 leading-relaxed">
                                {{ session('success') }}
                            </p>
                        </div>
                        <button type="button" class="text-emerald-400 hover:text-emerald-600 transition-colors cursor-pointer text-sm font-medium px-1" onclick="this.parentElement.remove()">
                            ✕
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 bg-white border border-rose-200 rounded-xl shadow-xs flex items-start gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-rose-600 flex items-center justify-center text-white text-xs font-bold shadow-xs">
                            ✕
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-rose-900">Atención</h4>
                            <ul class="mt-0.5 text-sm text-rose-700/90 leading-relaxed list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-xs">
                    <form action="{{ route('login.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                                Correo electrónico
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="tu@ejemplo.com"
                                class="w-full px-3.5 py-2.5 bg-slate-50 border @error('email') border-rose-300 focus:ring-rose-500 focus:border-rose-500 @else border-slate-200 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-xl shadow-xs text-sm text-slate-900 placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:bg-white transition-all"
                            >
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="password" class="block text-sm font-medium text-slate-700">
                                    Contraseña
                                </label>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                placeholder="••••••••"
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl shadow-xs text-sm text-slate-900 placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all"
                            >
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2.5 border border-transparent rounded-xl shadow-xs text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors cursor-pointer"
                            >
                                Iniciar sesión
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
