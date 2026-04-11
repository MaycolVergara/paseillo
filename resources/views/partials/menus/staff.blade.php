<div>
    <button data-tip="Personal"
            class="nav-parent group w-full flex items-center gap-3.5 px-3 py-3 rounded-xl text-base font-semibold text-gray-600 dark:text-gray-400 transition-all duration-200 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 dark:hover:text-orange-400"
            onclick="toggleAccordion(this)">
        <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-orange-100 dark:group-hover:bg-orange-900/30 group-hover:text-orange-500 transition-colors duration-200 shrink-0">
            {{-- Icono principal: Usuarios --}}
            <i data-lucide="users" class="w-4 h-4"></i>
        </span>
        <span class="nav-item-text flex-1 text-left whitespace-nowrap overflow-hidden">Personal</span>
        <span class="nav-chevron-wrap">
            {{-- Flecha del acordeón --}}
            <i data-lucide="chevron-down" class="chevron-icon w-5 h-5 text-gray-400 shrink-0 transition-transform duration-200"></i>
        </span>
    </button>

    <div class="submenu-wrapper">
        <div class="submenu-inner">
            <div class="ml-5 pl-4 mt-1.5 mb-1 border-l-2 border-dashed border-gray-200 dark:border-gray-700 space-y-1">

                {{-- Reporte del Personal --}}
                <a href="{{ url('/dashboard/staffreport') }}"
                   class="nav-link sub-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 transition-all duration-200">
                    <i data-lucide="file-text" class="w-4 h-4 shrink-0"></i>
                    Reporte del Personal
                </a>

            </div>
        </div>
    </div>
</div>
