<!-- ══════════════ HERO ══════════════ -->
<section
    id="inicio"
    class="relative min-h-screen flex items-center overflow-hidden clip-diagonal"
>
    <!-- BG Image burger -->
    <div class="absolute inset-0">
        <img
            src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=1920&q=85"
            alt="Hamburguesa Paseillo"
            class="w-full h-full object-cover object-center"
        />
    </div>
    <!-- Gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-black/30"></div>
    <div
        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"
    ></div>

    <div
        class="relative z-10 w-full max-w-5xl mx-auto px-4 sm:px-6 pt-28 pb-32 md:pt-36 md:pb-40 flex flex-col items-center text-center"
    >
        <!-- Tag -->
        <div
            class="inline-flex items-center gap-2 bg-brand/20 border border-brand/50 backdrop-blur-sm rounded-full px-4 py-1.5 mb-6"
        >
            <span class="w-2 h-2 bg-brand rounded-full animate-pulse"></span>
            <span class="font-condensed text-xs font-700 tracking-[3px] text-brand/90 uppercase"
            >🔥 Huanta, Ayacucho</span
            >
        </div>

        <!-- Title -->
        <h1
            class="font-anton text-[clamp(52px,9vw,110px)] leading-none text-white uppercase mb-6 tracking-wide"
        >
            PASEILLO<br />
            <span class="text-brand">PIZZAS</span><br />
            <span class="text-white/20">&amp; BURGER</span>
        </h1>

        <p class="text-white/70 text-lg leading-relaxed max-w-xl mb-10 font-barlow">
            Disfruta las mejores pizzas, hamburguesas, krispy y salchipapas con el sabor único de
            Paseillo. Preparado con ingredientes frescos y mucho amor.
        </p>

        <!-- Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-14">
            <a
                href="#especialidades"
                class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-sm uppercase tracking-widest px-8 py-4 rounded-full shadow-[0_6px_24px_rgba(227,6,19,0.5)] hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(227,6,19,0.55)] transition-all duration-300"
            >
                Ver Especialidades
            </a>
            <a
                href="https://wa.me/51000000000?text=Hola%2C%20quiero%20ordenar"
                target="_blank"
                class="inline-flex items-center gap-2 border-2 border-white/50 hover:border-white text-white hover:bg-white/10 font-condensed font-800 text-sm uppercase tracking-widest px-8 py-4 rounded-full backdrop-blur-sm hover:-translate-y-1 transition-all duration-300"
            >
                📲 Ordenar Ahora
            </a>
        </div>

        <!-- Stats -->
        <div class="flex gap-8 flex-wrap justify-center">
            <div class="text-center">
                <div class="font-anton text-4xl text-brand">500+</div>
                <div class="font-condensed text-xs tracking-widest text-white/50 uppercase mt-1">
                    Pedidos / mes
                </div>
            </div>
            <div class="w-px bg-white/10 self-stretch"></div>
            <div class="text-center">
                <div class="font-anton text-4xl text-white">4.9 ⭐</div>
                <div class="font-condensed text-xs tracking-widest text-white/50 uppercase mt-1">
                    Valoración
                </div>
            </div>
            <div class="w-px bg-white/10 self-stretch"></div>
            <div class="text-center">
                <div class="font-anton text-4xl text-brand">12+</div>
                <div class="font-condensed text-xs tracking-widest text-white/50 uppercase mt-1">
                    Especialidades
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div
        class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 z-10 animate-float"
    >
        <div class="font-condensed text-xs tracking-widest text-white/40 uppercase">Scroll</div>
        <div class="w-px h-10 bg-gradient-to-b from-white/40 to-transparent"></div>
    </div>
</section>

<!-- ══════════════ TICKER ══════════════ -->
<div class="bg-brand py-3 overflow-hidden">
    <div class="ticker-wrap">
        <div class="ticker-inner">
            <!-- repeat twice for seamless loop -->
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >🍕 Pizzas Artesanales</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >🍔 Burgers Jugosas</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >🍗 Krispy Crujiente</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >🍟 Salchipapas Famosas</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >📲 Pide por WhatsApp</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <!-- duplicate -->
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >🍕 Pizzas Artesanales</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >🍔 Burgers Jugosas</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >🍗 Krispy Crujiente</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >🍟 Salchipapas Famosas</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6"
            >📲 Pide por WhatsApp</span
            >
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
        </div>
    </div>
</div>
