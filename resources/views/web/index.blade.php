@extends('layouts.web')

@section('content')
<!-- ══════════════ HEADER ══════════════ -->
<header id="nav" class="fixed top-0 left-0 right-0 z-50 bg-white transition-all duration-300">
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
            <!-- Logo — 📌 cambia "img/logo.png" por la ruta de tu logo -->
            <a href="#inicio" class="flex items-center flex-shrink-0">
                <img src="img/logo.png" alt="Paseillo Pizzas & Burger" class="h-10 w-auto object-contain" />
            </a>
            <!-- Desktop nav -->
            <nav class="hidden lg:flex items-center gap-5">
                <a href="#inicio" class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors">Inicio</a>
                <a href="#especialidades" class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors">Especialidades</a>
                <a href="#combos" class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors">Combos</a>
                <a href="#carta" class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors">La Carta</a>
                <a href="#galeria" class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors">Galería</a>
                <a href="#nosotros" class="nav-link font-condensed font-700 text-sm tracking-wide uppercase text-gray-700 hover:text-brand transition-colors">Nosotros</a>
            </nav>
            <!-- CTA + hamburger -->
            <div class="flex items-center gap-3">
                <a href="https://wa.me/51000000000?text=Quiero%20ordenar" target="_blank" class="hidden sm:inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-sm uppercase tracking-wider px-5 py-2.5 rounded-full shadow-[0_4px_16px_rgba(227,6,19,0.35)] hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(227,6,19,0.45)] transition-all duration-300">
                    <span>📲</span> Ordenar ahora
                </a>
                <button id="ham" class="lg:hidden w-10 h-10 flex flex-col justify-center items-center gap-1.5 rounded-lg hover:bg-gray-50 transition-colors">
                    <span class="block w-5 h-0.5 bg-gray-800 transition-all duration-300 origin-center"></span>
                    <span class="block w-5 h-0.5 bg-gray-800 transition-all duration-300"></span>
                    <span class="block w-5 h-0.5 bg-gray-800 transition-all duration-300 origin-center"></span>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile menu -->
    <div id="mob" class="lg:hidden max-h-0 overflow-hidden transition-[max-height] duration-400 bg-white border-b border-gray-100">
        <div class="px-4 py-4 flex flex-col gap-1">
            <a href="#inicio" onclick="closeNav()" class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all">Inicio</a>
            <a href="#especialidades" onclick="closeNav()" class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all">Especialidades</a>
            <a href="#combos" onclick="closeNav()" class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all">Combos</a>
            <a href="#carta" onclick="closeNav()" class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all">La Carta</a>
            <a href="#galeria" onclick="closeNav()" class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all">Galería</a>
            <a href="#nosotros" onclick="closeNav()" class="font-condensed font-700 text-base uppercase tracking-wide text-gray-800 hover:text-brand py-2.5 px-3 rounded-lg hover:bg-brand/5 transition-all">Nosotros</a>
            <a href="https://wa.me/51000000000" target="_blank" class="mt-2 flex items-center justify-center gap-2 bg-brand text-white font-condensed font-800 uppercase tracking-wide text-sm py-3 rounded-xl shadow-[0_4px_16px_rgba(227,6,19,0.35)]">
                📲 Ordenar ahora
            </a>
        </div>
    </div>
</header>

<!-- ══════════════ HERO ══════════════ -->
<section id="inicio" class="relative min-h-screen flex items-center overflow-hidden clip-diagonal">
    <!-- BG Image burger -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=1920&q=85" alt="Hamburguesa Paseillo" class="w-full h-full object-cover object-center" />
    </div>
    <!-- Gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-black/30"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
    <div class="relative z-10 w-full max-w-5xl mx-auto px-4 sm:px-6 pt-28 pb-32 md:pt-36 md:pb-40 flex flex-col items-center text-center">
        <!-- Tag -->
        <div class="inline-flex items-center gap-2 bg-brand/20 border border-brand/50 backdrop-blur-sm rounded-full px-4 py-1.5 mb-6">
            <span class="w-2 h-2 bg-brand rounded-full animate-pulse"></span>
            <span class="font-condensed text-xs font-700 tracking-[3px] text-brand/90 uppercase">🔥 Huanta, Ayacucho</span>
        </div>
        <!-- Title -->
        <h1 class="font-anton text-[clamp(52px,9vw,110px)] leading-none text-white uppercase mb-6 tracking-wide">
            PASEILLO<br /><span class="text-brand">PIZZAS</span><br /><span class="text-white/20">&amp; BURGER</span>
        </h1>
        <p class="text-white/70 text-lg leading-relaxed max-w-xl mb-10 font-barlow">Disfruta las mejores pizzas, hamburguesas, krispy y salchipapas con el sabor único de Paseillo. Preparado con ingredientes frescos y mucho amor.</p>
        <!-- Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-14">
            <a href="#especialidades" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-condensed font-800 text-sm uppercase tracking-widest px-8 py-4 rounded-full shadow-[0_6px_24px_rgba(227,6,19,0.5)] hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(227,6,19,0.55)] transition-all duration-300">
                Ver Especialidades
            </a>
            <a href="https://wa.me/51000000000?text=Hola%2C%20quiero%20ordenar" target="_blank" class="inline-flex items-center gap-2 border-2 border-white/50 hover:border-white text-white hover:bg-white/10 font-condensed font-800 text-sm uppercase tracking-widest px-8 py-4 rounded-full backdrop-blur-sm hover:-translate-y-1 transition-all duration-300">
                📲 Ordenar Ahora
            </a>
        </div>
        <!-- Stats -->
        <div class="flex gap-8 flex-wrap justify-center">
            <div class="text-center">
                <div class="font-anton text-4xl text-brand">500+</div>
                <div class="font-condensed text-xs tracking-widest text-white/50 uppercase mt-1">Pedidos / mes</div>
            </div>
            <div class="w-px bg-white/10 self-stretch"></div>
            <div class="text-center">
                <div class="font-anton text-4xl text-white">4.9 ⭐</div>
                <div class="font-condensed text-xs tracking-widest text-white/50 uppercase mt-1">Valoración</div>
            </div>
            <div class="w-px bg-white/10 self-stretch"></div>
            <div class="text-center">
                <div class="font-anton text-4xl text-brand">12+</div>
                <div class="font-condensed text-xs tracking-widest text-white/50 uppercase mt-1">Especialidades</div>
            </div>
        </div>
    </div>
    <!-- Scroll indicator -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 z-10 animate-float">
        <div class="font-condensed text-xs tracking-widest text-white/40 uppercase">Scroll</div>
        <div class="w-px h-10 bg-gradient-to-b from-white/40 to-transparent"></div>
    </div>
</section>

<!-- ══════════════ TICKER ══════════════ -->
<div class="bg-brand py-3 overflow-hidden">
    <div class="ticker-wrap">
        <div class="ticker-inner">
            <!-- repeat twice for seamless loop -->
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">🍕 Pizzas Artesanales</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">🍔 Burgers Jugosas</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">🍗 Krispy Crujiente</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">🍟 Salchipapas Famosas</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">📲 Pide por WhatsApp</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <!-- duplicate -->
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">🍕 Pizzas Artesanales</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">🍔 Burgers Jugosas</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">🍗 Krispy Crujiente</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">🍟 Salchipapas Famosas</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
            <span class="font-condensed font-800 text-white text-sm uppercase tracking-widest mx-6">📲 Pide por WhatsApp</span>
            <span class="font-condensed font-800 text-white/50 text-sm mx-3">◆</span>
        </div>
    </div>
</div>

@include('partials.webPartials.sectionWeb.especialidadesSection')
@include('partials.webPartials.sectionWeb.promoStripSection')
@include('partials.webPartials.sectionWeb.combosSection')
@include('partials.webPartials.sectionWeb.cartaSection')
@include('partials.webPartials.sectionWeb.galeriaSection')
@include('partials.webPartials.sectionWeb.nosotrosSection')
@include('partials.webPartials.sectionWeb.preguntasFrecuentesSection')
@include('partials.webPartials.footer')
@include('partials.webPartials.whatsappFloat')
@endsection
