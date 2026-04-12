<!-- ══════════════ HEADER ══════════════ -->
<header id="nav" class="fixed left-0 right-0 top-0 z-50 bg-white transition-all duration-300">
    <div class="border-b border-gray-100">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6">

            <!-- Logo — 📌 cambia "img/logo.png" por la ruta de tu logo -->
            <a href="{{ url('/') }}" class="flex items-center flex-shrink-0">
                <img src="/img/logo_principal.png" alt="Paseillo Pizzas & Burger" class="h-12 w-auto object-contain" />
            </a>

            <!-- Desktop nav -->
            <nav class="hidden items-center gap-5 lg:flex">
                <a href="#inicio"
                    class="nav-link font-condensed font-700 hover:text-brand text-sm uppercase tracking-wide text-gray-700 transition-colors">Inicio</a>



                <a href="#carta"
                    class="nav-link font-condensed font-700 hover:text-brand text-sm uppercase tracking-wide text-gray-700 transition-colors">Platos</a>

                <a href="#galeria"
                    class="nav-link font-condensed font-700 hover:text-brand text-sm uppercase tracking-wide text-gray-700 transition-colors">Galería</a>
                <a href="#nosotros"
                    class="nav-link font-condensed font-700 hover:text-brand text-sm uppercase tracking-wide text-gray-700 transition-colors">Nosotros</a>
                <a href="#preguntas"
                    class="nav-link font-condensed font-700 hover:text-brand text-sm uppercase tracking-wide text-gray-700 transition-colors">Preguntas</a>
            </nav>

            <!-- CTA + hamburger -->
            <div class="flex items-center gap-3">
                <a href="https://wa.me/51000000000?text=Quiero%20ordenar" target="_blank"
                    class="bg-brand hover:bg-brand-dark font-condensed font-800 hidden items-center gap-2 rounded-full px-5 py-2.5 text-sm uppercase tracking-wider text-white shadow-[0_4px_16px_rgba(227,6,19,0.35)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(227,6,19,0.45)] sm:inline-flex">
                    <img src="/icon/whatsapp.png" alt="WhatsApp" class="w-9 h-9">Ordenar ahora
                </a>
                <button id="ham"
                    class="flex h-10 w-10 flex-col items-center justify-center gap-1.5 rounded-lg transition-colors hover:bg-gray-50 lg:hidden">
                    <span class="block h-0.5 w-5 origin-center bg-gray-800 transition-all duration-300"></span>
                    <span class="block h-0.5 w-5 bg-gray-800 transition-all duration-300"></span>
                    <span class="block h-0.5 w-5 origin-center bg-gray-800 transition-all duration-300"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mob"
        class="duration-400 max-h-0 overflow-hidden border-b border-gray-100 bg-white transition-[max-height] lg:hidden">
        <div class="flex flex-col gap-1 px-4 py-4">
            <a href="#inicio" onclick="closeNav()"
                class="font-condensed font-700 hover:text-brand hover:bg-brand/5 rounded-lg px-3 py-2.5 text-base uppercase tracking-wide text-gray-800 transition-all">Inicio</a>

            <a href="#carta" onclick="closeNav()"
                class="font-condensed font-700 hover:text-brand hover:bg-brand/5 rounded-lg px-3 py-2.5 text-base uppercase tracking-wide text-gray-800 transition-all">Platos</a>

            <a href="#galeria" onclick="closeNav()"
                class="font-condensed font-700 hover:text-brand hover:bg-brand/5 rounded-lg px-3 py-2.5 text-base uppercase tracking-wide text-gray-800 transition-all">Galería</a>

            <a href="#nosotros" onclick="closeNav()"
                class="font-condensed font-700 hover:text-brand hover:bg-brand/5 rounded-lg px-3 py-2.5 text-base uppercase tracking-wide text-gray-800 transition-all">Nosotros</a>

            <a href="#preguntas"
                class="nav-link font-condensed font-700 hover:text-brand text-sm uppercase tracking-wide text-gray-700 transition-colors">Preguntas</a>

            <a href="https://wa.me/51000000000" target="_blank"
                class="bg-brand font-condensed font-800 mt-2 flex items-center justify-center gap-2 rounded-xl py-3 text-sm uppercase tracking-wide text-white shadow-[0_4px_16px_rgba(227,6,19,0.35)]">
                📲 Ordenar ahora
            </a>
        </div>
    </div>
</header>
