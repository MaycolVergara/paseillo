<!doctype html>
<html lang="es" data-theme="day">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Paseillo</title>

    {{-- 1. Tu fuente original --}}
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>

    {{-- 3. Tus estilos extra --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- 2. El motor local de Tailwind y JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body
    class="bg-gray-50 dark:bg-gray-950 text-gray-800 dark:text-gray-100 font-sans antialiased transition-colors duration-300">
<div class="flex min-h-screen">

    @include('partials.sidebar')

    <div id="main-area" class="ml-72 flex-1 flex flex-col min-h-screen">

        @include('partials.navbar')

        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</div>

<script src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('js/lucide_icon/lucide.min.js') }}"></script>
<script src="{{ asset('js/lucide_icon/lucide_js/lucide.js') }}"></script>

</body>
</html>
