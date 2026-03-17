<!-- ══════════════ HERO ══════════════ -->
<section
    id="inicio"
    class="clip-diagonal relative flex min-h-screen items-center overflow-hidden"
>
    <!-- BG Image burger -->
    <div class="absolute inset-0">
        <img
            src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=1920&q=85"
            alt="Hamburguesa Paseillo"
            class="h-full w-full object-cover object-center"
        />
    </div>
    <!-- Gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-black/30"></div>
    <div
        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"
    ></div>

    <div
        class="relative z-10 mx-auto flex w-full max-w-5xl flex-col items-center px-4 pb-32 pt-28 text-center sm:px-6 md:pb-40 md:pt-36"
    >
        <!-- Tag -->
        <div
            class="bg-brand/20 border-brand/50 mb-6 inline-flex items-center gap-2 rounded-full border px-4 py-1.5 backdrop-blur-sm"
        >
            <span class="bg-brand h-2 w-2 animate-pulse rounded-full"></span>
            <span class="font-condensed font-700 text-brand/90 text-xs uppercase tracking-[3px]"
            >🔥 Huanta, Ayacucho</span
            >
        </div>

        <!-- Title -->
        <h1
            class="font-anton mb-6 text-[clamp(52px,9vw,110px)] uppercase leading-none tracking-wide text-white"
        >
            PASEILLO<br />
            <span class="text-brand">PIZZAS</span><br />
            <span class="text-white/20">&amp; BURGER</span>
        </h1>

        <p class="font-barlow mb-10 max-w-xl text-lg leading-relaxed text-white/70">
            Disfruta las mejores pizzas, hamburguesas, krispy y salchipapas con el sabor único de
            Paseillo. Preparado con ingredientes frescos y mucho amor.
        </p>

        <!-- Buttons -->
        <div class="mb-14 flex flex-wrap justify-center gap-4">
            <a
                href="#especialidades"
                class="bg-brand hover:bg-brand-dark font-condensed font-800 inline-flex items-center gap-2 rounded-full px-8 py-4 text-sm uppercase tracking-widest text-white shadow-[0_6px_24px_rgba(227,6,19,0.5)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(227,6,19,0.55)]"
            >
                Ver Especialidades
            </a>
            <a
                href="https://wa.me/51000000000?text=Hola%2C%20quiero%20ordenar"
                target="_blank"
                class="font-condensed font-800 inline-flex items-center gap-2 rounded-full border-2 border-white/50 px-8 py-4 text-sm uppercase tracking-widest text-white backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:border-white hover:bg-white/10"
            >
                📲 Ordenar Ahora
            </a>

            <a
                href="/cartaPaseilloCompleta"
                class="bg-brand hover:bg-brand-dark font-condensed font-800 inline-flex items-center gap-2 rounded-full px-8 py-4 text-sm uppercase tracking-widest text-white shadow-[0_6px_24px_rgba(227,6,19,0.5)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(227,6,19,0.55)]"
            >
                VER CARTA COMPLETA
            </a>
        </div>

        <!-- Stats -->
        <div class="flex flex-wrap justify-center gap-8">
            <div class="text-center">
                <div class="font-anton text-brand text-4xl">500+</div>
                <div class="font-condensed mt-1 text-xs uppercase tracking-widest text-white/50">
                    Pedidos / mes
                </div>
            </div>
            <div class="w-px self-stretch bg-white/10"></div>
            <div class="text-center">
                <div class="font-anton text-4xl text-white">4.9 ⭐</div>
                <div class="font-condensed mt-1 text-xs uppercase tracking-widest text-white/50">
                    Valoración
                </div>
            </div>
            <div class="w-px self-stretch bg-white/10"></div>
            <div class="text-center">
                <div class="font-anton text-brand text-4xl">12+</div>
                <div class="font-condensed mt-1 text-xs uppercase tracking-widest text-white/50">
                    Especialidades
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div
        class="animate-float absolute bottom-10 left-1/2 z-10 flex -translate-x-1/2 flex-col items-center gap-2"
    >
        <div class="font-condensed text-xs uppercase tracking-widest text-white/40">Scroll</div>
        <div class="h-10 w-px bg-gradient-to-b from-white/40 to-transparent"></div>
    </div>
</section>
<!-- ══════════════ TICKER ══════════════ -->
<div class="bg-brand overflow-hidden py-3">
    <div class="ticker-wrap">
        <div class="ticker-inner">
            <!-- repeat twice for seamless loop -->
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >🍕 Pizzas Artesanales</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >🍔 Burgers Jugosas</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >🍗 Krispy Crujiente</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >🍟 Salchipapas Famosas</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >📲 Pide por WhatsApp</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <!-- duplicate -->
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >🍕 Pizzas Artesanales</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >🍔 Burgers Jugosas</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >🍗 Krispy Crujiente</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >🍟 Salchipapas Famosas</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
            <span class="font-condensed font-800 mx-6 text-sm uppercase tracking-widest text-white"
            >📲 Pide por WhatsApp</span
            >
            <span class="font-condensed font-800 mx-3 text-sm text-white/50">◆</span>
        </div>
    </div>
</div>
