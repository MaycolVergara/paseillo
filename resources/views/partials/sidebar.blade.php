<aside id="sidebar"
       class="w-72 shrink-0 bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 flex flex-col
       fixed inset-y-0 left-0 z-30 shadow-sm overflow-hidden">


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

    <nav class="flex-1 overflow-y-auto px-4 py-5 space-y-1">
        @if(Auth::user()->rol==1)
            @include('partials.menus.inicio')
            @include('partials.menus.redireccion_mesa')
            @include('partials.menus.registros')
            @include('partials.menus.categorias')
            @include('partials.menus.ventas')
        @endif
        @if(Auth::user()->rol==2)
            @include('partials.menus.inicio')
            @include('partials.menus.redireccion_mesa')

        @endif

    </nav>


</aside>
