<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('img/icono.ico') }}">

    <!-- Estilos de bootstrap -->
    @vite(['resources/sass/app.scss'])
    <!-- Estilos css generales -->
    @vite(['resources/css/base/css/general.css', 'resources/css/base/css/menu.css', 'resources/css/base/css/footer.css'])

    <!-- Estilos cambiantes -->
    @yield("styles")
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")</title>
</head>

<body>

    <div class="content">
        <!-- Incluir menú -->
        @include("layouts.menu")
        <section class="section">
            @yield("content")
        </section>

        <!-- Incluir footer -->
        @include("layouts.footer")
    </div>
    @yield("scripts")
    <!-- Scripts de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>