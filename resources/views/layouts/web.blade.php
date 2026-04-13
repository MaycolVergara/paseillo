<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paseillo Pizzas & Burger — Huanta</title>
    
    {{-- Assets Localizados (Vite) --}}
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

{{-- WHATSAPP FLOAT --}}
@include('partials.webPartials.whatsappFloat')

{{-- Scripts al Final para Estabilidad --}}
<script src="{{ asset('js/lucide_icon/lucide.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            window.lucide.createIcons();
        }
    });
    // Fallback inmediato
    if (window.lucide) {
        window.lucide.createIcons();
    }
</script>

</body>
</html>
