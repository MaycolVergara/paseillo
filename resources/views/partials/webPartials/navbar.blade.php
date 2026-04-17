<!-- ══════════════ HEADER ══════════════ -->
<header
    id="nav"
    class="fixed top-0 left-0 right-0 z-50 bg-white transition-all duration-300"
>
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
            <!-- Logo — 📌 cambia "img/logo.png" por la ruta de tu logo -->
            <a
                href="#inicio"
                class="flex items-center flex-shrink-0"
            >
                <img
                    src="img/logo_principal.png"
                    alt="Paseillo Pizzas & Burger"
                    class="h-10 w-auto object-contain"
                />
            </a>

            <!-- Desktop nav -->
            <nav class="hidden lg:flex items-center gap-5">
                <a
                    href="#inicio"
                    class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors"
                >Inicio</a
                >
                <a
                    href="#especialidades"
                    class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors"
                >Especialidades</a
                >
                <a
                    href="https://www.canva.com/design/DAFRjwshRm0/b9XXMYbAoiND-BtSCxWuEQ/view?website#4:carta"
                    target="_blank"
                    class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors"
                >Carta</a
                >

                <a
                    href="#galeria"
                    class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors"
                >Galería</a
                >
                <a
                    href="#nosotros"
                    class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors"
                >Nosotros</a
                >

                <a
                    href="#faq"
                    class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors"
                >Preguntas Frecuentes</a
                >
            </nav>

            <!-- CTA + hamburger -->
            <div class="flex items-center gap-3">
                <a
                    href="https://wa.me/51921829555?text=Hola%20Paseillo%2C%20quiero%20hacer%20un%20pedido"
                    target="_blank"
                    class="hidden sm:inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-sm uppercase tracking-wider px-5 py-2.5 rounded-full shadow-[0_4px_16px_rgba(227,6,19,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(227,6,19,0.45)] transition-all duration-300"
                >
                    <img
                        src="icon/whatsapp.png"
                        alt="Paseillo Pizzas & Burger"
                        class="h-8 w-8 object-contain"
                    /> Ordenar ahora
                </a>
                <button
                    id="ham"
                    class="lg:hidden w-10 h-10 flex flex-col justify-center items-center gap-1.5 rounded-lg hover:bg-gray-50 transition-colors"
                >
              <span
                  class="block w-5 h-0.5 bg-gray-800 transition-all duration-300 origin-center"
              ></span>
                    <span class="block w-5 h-0.5 bg-gray-800 transition-all duration-300"></span>
                    <span
                        class="block w-5 h-0.5 bg-gray-800 transition-all duration-300 origin-center"
                    ></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div
        id="mob"
        class="lg:hidden max-h-0 overflow-hidden transition-[max-height] duration-400 bg-white border-b border-gray-100"
    >
        <div class="px-4 py-4 flex flex-col gap-1">
            <a
                href="#inicio"
                onclick="closeNav()"
                class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all"
            >Inicio</a
            >
            <a
                href="#especialidades"
                onclick="closeNav()"
                class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all"
            >Especialidades</a
            >
            <a
                href="https://www.canva.com/design/DAFRjwshRm0/b9XXMYbAoiND-BtSCxWuEQ/view?website#4:carta"
                target="_blank"
                onclick="closeNav()"
                class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all"
            >Carta</a
            >

            <a
                href="#galeria"
                onclick="closeNav()"
                class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all"
            >Galería</a
            >
            <a
                href="#nosotros"
                onclick="closeNav()"
                class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all"
            >Nosotros</a
            >

        </div>
    </div>
</header>
