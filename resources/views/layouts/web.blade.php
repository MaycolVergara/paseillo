<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Paseillo Pizzas & Burger — Huanta</title>
    <link rel="icon" href="img/logo_principal.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Barlow:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,800&family=Barlow+Condensed:wght@400;600;700;800;900&display=swap"
        rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: "#E30613",
                        "brand-dark": "#b80510",
                        "brand-black": "#0d0d0d",
                        "brand-gray": "#F5F5F5",
                    },
                    fontFamily: {
                        anton: ["Anton", "sans-serif"],
                        barlow: ["Barlow", "sans-serif"],
                        condensed: ["Barlow Condensed", "sans-serif"],
                    },
                    animation: {
                        float: "float 4s ease-in-out infinite",
                        float2: "float 4s ease-in-out 2s infinite",
                        ticker: "ticker 20s linear infinite",
                        "pulse-ring": "pulse-ring 2s ease-out infinite",
                        "slide-up": "slideUp 0.6s ease forwards",
                    },
                    keyframes: {
                        float: {"0%,100%": {transform: "translateY(0px)"}, "50%": {transform: "translateY(-12px)"}},
                        ticker: {"0%": {transform: "translateX(0)"}, "100%": {transform: "translateX(-50%)"}},
                        "pulse-ring": {
                            "0%": {transform: "scale(1)", opacity: "0.8"},
                            "100%": {transform: "scale(1.5)", opacity: "0"}
                        },
                        slideUp: {
                            from: {opacity: "0", transform: "translateY(40px)"},
                            to: {opacity: "1", transform: "translateY(0)"}
                        },
                    },
                },
            },
        };
    </script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Barlow", sans-serif;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: #e30613;
            border-radius: 3px;
        }

        .font-anton {
            font-family: "Anton", sans-serif;
        }

        .font-condensed {
            font-family: "Barlow Condensed", sans-serif;
        }

        /* Reveal on scroll */
        .reveal {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.on {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal.d1 {
            transition-delay: 0.1s;
        }

        .reveal.d2 {
            transition-delay: 0.2s;
        }

        .reveal.d3 {
            transition-delay: 0.3s;
        }

        .reveal.d4 {
            transition-delay: 0.4s;
        }

        /* Diagonal cut */
        .clip-diagonal {
            clip-path: polygon(0 0, 100% 0, 100% 88%, 0 100%);
        }

        .clip-diagonal-top {
            clip-path: polygon(0 12%, 100% 0, 100% 100%, 0 100%);
        }

        /* Ticker */
        .ticker-wrap {
            overflow: hidden;
            white-space: nowrap;
        }

        .ticker-inner {
            display: inline-flex;
            animation: ticker 22s linear infinite;
        }

        /* Hover zoom image */
        .img-zoom {
            overflow: hidden;
        }

        .img-zoom img {
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .img-zoom:hover img {
            transform: scale(1.08);
        }

        /* Nav underline */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #e30613;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Card shine */
        .card-shine {
            position: relative;
            overflow: hidden;
        }

        .card-shine::before {
            content: "";
            position: absolute;
            top: 0;
            left: -75%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
            transition: left 0.6s ease;
            z-index: 10;
        }

        .card-shine:hover::before {
            left: 125%;
        }

        /* Carta tabs */
        .carta-tab.active-carta {
            background: #e30613 !important;
            color: #fff !important;
        }
    </style>
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
@include('partials.webPartials.IconsFloat')

<!-- ══════════════ SCRIPTS ══════════════ -->
@vite(['resources/js/app.js'])

</body>
</html>
