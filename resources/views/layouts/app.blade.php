<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Book ISAM')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="min-h-full bg-emerald-50 text-slate-900 font-sans antialiased flex flex-col">

    <x-menu />

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('contenido')
    </main>

</body>

</html>
