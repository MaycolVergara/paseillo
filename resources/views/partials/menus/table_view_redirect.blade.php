@if(Auth::user()->role_id == 1)
    <p class="sb-section-label px-3 pt-5 mb-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-600">
        Tus mesas</p>

    {{-- Mesas Normales --}}
    <a href="{{ url('/dashboard/tableView') }}" data-tip="Tus Mesas"
       class="nav-link group flex items-center gap-3.5 px-3 py-3 rounded-xl text-base font-semibold text-gray-600 dark:text-gray-400 transition-all duration-200 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 dark:hover:text-orange-400">
    <span
        class="flex items-center justify-center w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-orange-100 dark:group-hover:bg-orange-900/30 group-hover:text-orange-500 transition-colors duration-200 shrink-0">
        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
    </span>
        <span class="nav-item-text flex-1 whitespace-nowrap overflow-hidden">Mesas</span>
        <span class="nav-item-text nav-dot w-2 h-2 rounded-full shrink-0"></span>
    </a>

    {{-- Mesas Delivery --}}
    <a href="{{ url('/dashboard/customerTableDelyveryView') }}" data-tip="Mesas Delivery"
       class="nav-link group flex items-center gap-3.5 px-3 py-3 rounded-xl text-base font-semibold text-gray-600 dark:text-gray-400 transition-all duration-200 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 dark:hover:text-orange-400">
    <span
        class="flex items-center justify-center w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-orange-100 dark:group-hover:bg-orange-900/30 group-hover:text-orange-500 transition-colors duration-200 shrink-0">
        <i data-lucide="bike" class="w-4 h-4"></i>
    </span>
        <span class="nav-item-text flex-1 whitespace-nowrap overflow-hidden">Mesas Delivery</span>
        <span class="nav-item-text nav-dot w-2 h-2 rounded-full shrink-0"></span>
    </a>
@endif
@if(Auth::user()->role_id == 2)
    <p class="sb-section-label px-3 pt-5 mb-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-600">
        Tus mesas</p>

    {{-- Mesas Normales --}}
    <a href="{{ url('/dashboard/tableView') }}" data-tip="Tus Mesas"
       class="nav-link group flex items-center gap-3.5 px-3 py-3 rounded-xl text-base font-semibold text-gray-600 dark:text-gray-400 transition-all duration-200 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 dark:hover:text-orange-400">
    <span
        class="flex items-center justify-center w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-orange-100 dark:group-hover:bg-orange-900/30 group-hover:text-orange-500 transition-colors duration-200 shrink-0">
        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
    </span>
        <span class="nav-item-text flex-1 whitespace-nowrap overflow-hidden">Mesas</span>
        <span class="nav-item-text nav-dot w-2 h-2 rounded-full shrink-0"></span>
    </a>
@endif


