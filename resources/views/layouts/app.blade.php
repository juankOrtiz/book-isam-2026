<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Book ISAM')</title>
</head>

<body>
    <x-menu />

    <main>
        @yield('contenido')
    </main>
</body>

</html>
