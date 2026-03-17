<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paseillo Pizzas & Burger — Huanta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="{{ asset('css/web.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Barlow:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,800&family=Barlow+Condensed:wght@400;600;700;800;900&display=swap"
        rel="stylesheet"
    />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#E30613',
                        'brand-dark': '#b80510',
                        'brand-black': '#0d0d0d',
                        'brand-gray': '#F5F5F5',
                    },
                    fontFamily: {
                        anton: ['Anton', 'sans-serif'],
                        barlow: ['Barlow', 'sans-serif'],
                        condensed: ['Barlow Condensed', 'sans-serif'],
                    },
                    animation: {
                        float: 'float 4s ease-in-out infinite',
                        float2: 'float 4s ease-in-out 2s infinite',
                        ticker: 'ticker 20s linear infinite',
                        'pulse-ring': 'pulse-ring 2s ease-out infinite',
                        'slide-up': 'slideUp 0.6s ease forwards',
                    },
                    keyframes: {
                        float: {
                            '0%,100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        },
                        ticker: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(-50%)' },
                        },
                        'pulse-ring': {
                            '0%': { transform: 'scale(1)', opacity: '0.8' },
                            '100%': { transform: 'scale(1.5)', opacity: '0' },
                        },
                        slideUp: {
                            from: { opacity: '0', transform: 'translateY(40px)' },
                            to: { opacity: '1', transform: 'translateY(0)' },
                        },
                    },
                },
            },
        }
    </script>

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

<script src="{{ asset('js/web.js') }}"></script>
</body>
</html>

