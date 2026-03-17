<div>
    <button data-tip="Venta" class="nav-parent group w-full flex items-center gap-3.5 px-3 py-3 rounded-xl text-base font-semibold text-gray-600 dark:text-gray-400 transition-all duration-200 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 dark:hover:text-orange-400" onclick="toggleAccordion(this)">
        <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-orange-100 dark:group-hover:bg-orange-900/30 group-hover:text-orange-500 transition-colors duration-200 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm8-6a.75.75 0 01.75.75v.316a3.78 3.78 0 011.653.713c.426.33.744.74.925 1.2a.75.75 0 01-1.395.55 2.27 2.27 0 00-1.183-.335v2.14l.431.108c1.349.34 2.195 1.066 2.195 2.248 0 1.286-1.099 2.102-2.626 2.21V15.25a.75.75 0 01-1.5 0v-.321a4.304 4.304 0 01-2.062-.929.75.75 0 01.95-1.162c.39.32.845.528 1.362.61V11.02l-.378-.094c-1.48-.37-2.22-1.096-2.22-2.21 0-1.273 1.062-2.065 2.598-2.174V6.25A.75.75 0 0110 4z" clip-rule="evenodd"/></svg>
        </span>
        <span class="nav-item-text flex-1 text-left whitespace-nowrap overflow-hidden">Venta</span>
        <span class="nav-chevron-wrap"><svg class="chevron-icon w-5 h-5 text-gray-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.04 1.08l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg></span>
    </button>
    <div class="submenu-wrapper">
        <div class="submenu-inner">
            <div class="ml-5 pl-4 mt-1.5 mb-1 border-l-2 border-dashed border-gray-200 dark:border-gray-700 space-y-1">
                <a href="{{ url('/dashboard/ventas') }}" class="nav-link sub-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 transition-all duration-200">
                    <span class="w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600 shrink-0"></span> Reporte del día
                </a>
            </div>
        </div>
    </div>
</div>
