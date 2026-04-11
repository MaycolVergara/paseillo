<aside id="sidebar"
       class="w-72 shrink-0 bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 flex flex-col
       fixed inset-y-0 left-0 z-30 shadow-sm">

    <div class="sb-brand-wrap flex items-center gap-3 px-5 py-5 border-b border-gray-100 dark:border-gray-800">
        <img src="{{ asset('img/logo_principal.png') }}"
             alt="Logo Paseillo"
             class="w-20 h-auto object-contain shrink-0 dark:bg-white dark:p-1 dark:rounded-xl"
        />
        <div class="sb-brand-text overflow-hidden">
            <p class="font-bold text-lg text-gray-900 dark:text-white leading-none tracking-tight whitespace-nowrap">
                Paseillo</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 font-medium tracking-wide whitespace-nowrap">Sistema
                de Venta</p>
        </div>
    </div>

    <nav class="flex-1 min-h-0 overflow-y-auto px-4 py-5 space-y-1">
        {{-- Cambiado: rol -> role_id --}}
        @if(Auth::user()->role_id == 1)
            @include('partials.menus.dashboard_home')
            @include('partials.menus.table_view_redirect')
            @include('partials.menus.registrations')
            @include('partials.menus.categories')
            @include('partials.menus.sales')
            @include('partials.menus.staff')
        @endif

        {{-- Mozo: solo ve su área de mesas, sin acceso al dashboard admin --}}
        @if(Auth::user()->role_id == 2)
            @include('partials.menus.table_view_redirect')
        @endif
    </nav>

</aside>
