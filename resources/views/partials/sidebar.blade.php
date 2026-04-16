<aside id="sidebar"
       class="w-72 shrink-0 bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 flex flex-col
       fixed inset-y-0 left-0 z-50 shadow-sm transition-transform duration-300 transform -translate-x-full md:translate-x-0">

    <div class="sb-brand-wrap flex items-center gap-3 px-5 py-5 border-b border-gray-100 dark:border-gray-800">
        @php
            $logoPath = optional($settings)->company_logo ?? 'img/logo_principal.png';
            $finalLogo = (str_starts_with($logoPath, 'img/') ? asset($logoPath) : asset('storage/' . $logoPath));
        @endphp
        <img src="{{ $finalLogo }}"
             alt="Logo {{ optional($settings)->company_name ?? 'Paseillo' }}"
             class="w-8 h-8 object-contain">
        <div class="flex-1 min-w-0">
            <p class="text-sm font-black text-gray-900 dark:text-white truncate">
                {{ optional($settings)->company_name ?? 'Paseillo' }}</p>
            <p class="text-[10px] font-bold text-gray-400 dark:text-gray-500 truncate mt-0.5">
                {{ optional($settings)->company_subtitle ?? 'Sistema de Venta' }}</p>
        </div>
    </div>

    <nav class="flex-1 min-h-0 overflow-y-auto px-4 py-5 space-y-1">
        {{-- Cambiado: rol -> role_id --}}
        @if(Auth::user()->role_id == 1)
            @include('partials.menus.dashboard_home')
            @include('partials.menus.table_view_redirect')
            @include('partials.menus.gestion_registros')
            @include('partials.menus.gestion_ventas')
            @include('partials.menus.gestion_personal')
            @include('partials.menus.gestion_stock')
            @include('partials.menus.gestion_cliente')


        @endif

        {{-- Mozo: solo ve su área de mesas, sin acceso al dashboard admin --}}
        @if(Auth::user()->role_id == 2)
            @include('partials.menus.table_view_redirect')
        @endif
    </nav>

</aside>
