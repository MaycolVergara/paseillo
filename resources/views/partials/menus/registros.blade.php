@if(Auth::user()->rol==1)
    <p class="sb-section-label px-3 pt-5 mb-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-600">
        Gestión</p>
    <div>
        <button data-tip="Registros"
                class="nav-parent group w-full flex items-center gap-3.5 px-3 py-3 rounded-xl text-base font-semibold text-gray-600 dark:text-gray-400 transition-all duration-200 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 dark:hover:text-orange-400"
                onclick="toggleAccordion(this)">
        <span
            class="flex items-center justify-center w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-orange-100 dark:group-hover:bg-orange-900/30 group-hover:text-orange-500 transition-colors duration-200 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path
                    fill-rule="evenodd"
                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a.75.75 0 000 1.5h8a.75.75 0 000-1.5H6zm0 3a.75.75 0 000 1.5h5a.75.75 0 000-1.5H6z"
                    clip-rule="evenodd"/></svg>
        </span>
            <span class="nav-item-text flex-1 text-left whitespace-nowrap overflow-hidden">Registros</span>
            <span class="nav-chevron-wrap"><svg class="chevron-icon w-5 h-5 text-gray-400 shrink-0"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path
                        fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.04 1.08l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd"/></svg></span>
        </button>
        <div class="submenu-wrapper">
            <div class="submenu-inner">

                <!--PRODUCTOS-->
                <div class="ml-5 pl-4 mt-1.5 mb-1 border-l-2 border-dashed border-gray-200 dark:border-gray-700 space-y-1">
                    <a href="{{ url('/dashboard/productosListado')}}"
                       class="nav-link sub-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 transition-all duration-200">
                        <span class="w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600 shrink-0"></span> Productos
                    </a>
                </div>
                <!--CATEGORIA-->
                <div class="ml-5 pl-4 mt-1.5 mb-1 border-l-2 border-dashed border-gray-200 dark:border-gray-700 space-y-1">
                    <a href="{{ url('/dashboard/categoriasRegistro')}}"
                       class="nav-link sub-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 transition-all duration-200">
                        <span class="w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600 shrink-0"></span> Categoria
                    </a>
                </div>

                <!--MESAS-->
                <div class="ml-5 pl-4 mt-1.5 mb-1 border-l-2 border-dashed border-gray-200 dark:border-gray-700 space-y-1">
                    <a href="{{ url('/dashboard/mesasRegistros')}}"
                       class="nav-link sub-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 transition-all duration-200">
                        <span class="w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600 shrink-0"></span> Mesas
                    </a>
                </div>

                <!--Usuario-->
                <div class="ml-5 pl-4 mt-1.5 mb-1 border-l-2 border-dashed border-gray-200 dark:border-gray-700 space-y-1">
                    <a href="{{ url('/dashboard/usuariosRegistro')}}" class="nav-link sub-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 transition-all duration-200">
                        <span class="w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600 shrink-0"></span>
                        Usuarios
                    </a>
                </div>
            </div>
        </div>

    </div>

@endif
