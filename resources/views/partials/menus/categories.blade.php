<div>
    <button data-tip="Categoría"
            class="nav-parent group w-full flex items-center gap-3.5 px-3 py-3 rounded-xl text-base font-semibold text-gray-600 dark:text-gray-400 transition-all duration-200 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 dark:hover:text-orange-400"
            onclick="toggleAccordion(this)">
        <span class="flex items-center justify-center w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 group-hover:bg-orange-100 dark:group-hover:bg-orange-900/30 group-hover:text-orange-500 transition-colors duration-200 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path
                    fill-rule="evenodd"
                    d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z"
                    clip-rule="evenodd"/></svg>
        </span>
        <span class="nav-item-text flex-1 text-left whitespace-nowrap overflow-hidden">Categorías</span>
        <span class="nav-chevron-wrap"><svg class="chevron-icon w-5 h-5 text-gray-400 shrink-0"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path
                    fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.04 1.08l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd"/></svg></span>
    </button>
    <div class="submenu-wrapper">
        <div class="submenu-inner">
            <div class="ml-5 pl-4 mt-1.5 mb-1 border-l-2 border-dashed border-gray-200 dark:border-gray-700 space-y-1">
                @php
                    // Modelo actualizado: Categoria -> Category
                    $categoriesList = \App\Models\Category::all();
                @endphp
                @foreach($categoriesList as $category)
                    @php
                        // nombre_categoria -> name
                        $catName = strtolower($category->name);
                        $emoji = '🍽️';

                        if (str_contains($catName, 'pizza')) {
                            $emoji = '🍕';
                        } elseif (str_contains($catName, 'hamburguesa') || str_contains($catName, 'burger')) {
                            $emoji = '🍔';
                        } elseif (str_contains($catName, 'bebida') || str_contains($catName, 'gaseosa') || str_contains($catName, 'refresco')) {
                            $emoji = '🥤';
                        } elseif (str_contains($catName, 'krispy') || str_contains($catName, 'pollo') || str_contains($catName, 'broaster')) {
                            $emoji = '🍗';
                        } elseif (str_contains($catName, 'salchipapa') || str_contains($catName, 'papas')) {
                            $emoji = '🍟';
                        }
                    @endphp

                    <h5 class="flex items-center gap-3 px-2 py-1.5 group/item rounded-xl hover:bg-orange-50 dark:hover:bg-orange-950/20 transition-all">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-sm group-hover/item:scale-110 transition-transform shadow-sm">
                            {{ $emoji }}
                        </div>
                        <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 group-hover/item:text-orange-600 transition-colors">
                            {{ $category->name }}
                        </span>
                    </h5>
                @endforeach
            </div>
        </div>
    </div>
</div>
