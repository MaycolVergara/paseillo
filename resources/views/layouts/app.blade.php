<!doctype html>
<html lang="es" data-theme="day">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Paseillo</title>

    {{-- 1. Tu fuente original --}}
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>

    {{-- 2. Assets estructurados (Admin) --}}
    @vite(['resources/css/admin/admin.css', 'resources/js/admin/admin.js'])

</head>

<body
    class="bg-gray-50 dark:bg-gray-950 text-gray-800 dark:text-gray-100 font-sans antialiased transition-colors duration-300">
<div class="flex min-h-screen">

    @include('partials.sidebar')

    {{-- Backdrop para móvil --}}
    <div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 hidden md:hidden transition-opacity duration-300 opacity-0 pointer-events-none"></div>

    <div id="main-area" class="flex-1 flex flex-col min-h-screen transition-all duration-300 md:ml-72 w-full relative">

        @include('partials.navbar')

        <main class="flex-1 p-4 md:p-6">
            @yield('content')
        </main>

    </div>
</div>

    {{-- Scripts al final --}}
    <script src="{{ asset('js/lucide_icon/lucide.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
        // Segundo intento por si el DOM ya estaba listo
        if (window.lucide) {
            window.lucide.createIcons();
        }
    </script>
</body>
</html>
