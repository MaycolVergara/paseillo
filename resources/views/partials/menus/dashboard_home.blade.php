<p class="sb-section-label px-3 mb-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-600">Principal</p>

<a href="{{ url('/dashboard') }}" data-tip="Inicio" class="nav-link group flex items-center gap-3.5 px-3 py-3 rounded-xl text-base font-semibold transition-all duration-200 hover:bg-red-50 dark:hover:bg-red-950/30 hover:text-red-600 dark:hover:text-red-400">
    <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-gradient-to-br from-red-500 to-orange-400 text-white shadow-sm shrink-0">
        {{-- CAMBIO AQUÍ: Reemplazado el SVG por el icono de casa de Lucide --}}
        <i data-lucide="home" class="w-4 h-4"></i>
    </span>
    <span class="nav-item-text flex-1 whitespace-nowrap overflow-hidden">Inicio</span>
    <span class="nav-item-text nav-dot w-2 h-2 rounded-full shrink-0"></span>
</a>
