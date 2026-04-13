<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paseillo Pizzas & Burger — Huanta</title>
    {{-- Lucide Icons & localized assets --}}
    <script src="{{ asset('js/lucide_icon/lucide.min.js') }}"></script>
    @vite(['resources/css/web/web.css', 'resources/js/web/web.js'])
</head>

<body class="bg-white text-gray-900">

{{-- NAVBAR --}}
@include('partials.webPartials.navbar')

{{-- CONTENIDO DE LA PÁGINA --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
@include('partials.webPartials.footer')

</body>
</body>
</html>
