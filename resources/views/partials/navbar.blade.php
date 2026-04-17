@php
    $diaActual = \Carbon\Carbon::now()->day;

    $yaPagados = \App\Models\StaffPaymentModel::whereMonth('created_at', \Carbon\Carbon::now()->month)
        ->whereYear('created_at', \Carbon\Carbon::now()->year)
        ->where('payment_type', 'salary')
        ->pluck('staff_id')
        ->toArray();

    $personalAPagar = \App\Models\StaffModel::where('is_active', true)
        ->where('payment_day', $diaActual)
        ->whereNotIn('id', $yaPagados)
        ->get();

    $cantidadAPagar = $personalAPagar->count();

    // Cálculo Global de Stock Bajo
    $lowStockItems = \App\Models\StoreModel::whereColumn('current_stock', '<=', 'minimum_stock')->get();
@endphp

<header
    class="sticky top-0 z-20 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 shadow-sm">
    <div class="flex items-center h-[62px] px-3 sm:px-4 md:px-6 gap-2 sm:gap-4">
        <div class="flex items-center gap-3">
            <button onclick="toggleSidebar()" title="Colapsar menú"
                class="flex items-center justify-center w-8 h-8 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-500 transition-all duration-200">
                <i data-lucide="menu" class="w-[18px] h-[18px]"></i>
            </button>
            <div class="flex items-center gap-2 sm:gap-2.5 hidden lg:flex">
                <div class="w-1 h-5 rounded-full bg-gradient-to-b from-red-500 to-orange-400"></div>
                <h1 class="font-bold text-[15px] text-gray-800 dark:text-gray-100 tracking-tight">Panel Principal</h1>
            </div>
        </div>

        <div class="flex-1"></div>

        {{-- BOTÓN DE NOTIFICACIONES DE PAGOS (LA CAMPANITA) --}}
        <div class="relative group/bell flex items-center">
            <button
                class="relative p-2 text-gray-400 hover:text-orange-500 transition-all rounded-xl hover:bg-orange-50 dark:hover:bg-gray-800">
                <i data-lucide="bell" class="w-5 h-5"></i>

                {{-- Si hay personas por pagar hoy, mostramos el puntito rojo parpadeando --}}
                @if ($cantidadAPagar > 0)
                    <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span
                            class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white dark:border-gray-900"></span>
                    </span>
                @endif
            </button>

            {{-- Menú desplegable de notificaciones de pagos --}}
            <div
                class="absolute right-[-70px] sm:right-0 top-[calc(100%+10px)] w-72 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl z-[100] invisible group-hover/bell:visible opacity-0 group-hover/bell:opacity-100 transition-all duration-200 transform origin-top-right scale-95 group-hover/bell:scale-100 overflow-hidden">
                <div
                    class="px-4 py-3 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 flex justify-between items-center">
                    <h3 class="text-[13px] font-black text-gray-800 dark:text-white">Pagos Pendientes</h3>
                    <span
                        class="text-[10px] font-bold px-2 py-0.5 bg-orange-100 text-orange-600 rounded-full">{{ $cantidadAPagar }}
                        nuevas</span>
                </div>

                <div class="max-h-[300px] overflow-y-auto">
                    @if ($cantidadAPagar > 0)
                        @foreach ($personalAPagar as $staff)
                            <div
                                class="px-4 py-3 hover:bg-orange-50 dark:hover:bg-gray-800/50 transition-colors border-b border-gray-50 dark:border-gray-800 last:border-0">
                                <p class="text-[12px] font-bold text-gray-800 dark:text-gray-200">
                                    ¡Día de pago para <span class="text-orange-600">{{ $staff->name }}</span>!
                                </p>
                                <p class="text-[11px] text-gray-500 mt-0.5">
                                    {{ $staff->position }} • Sueldo: S/{{ number_format($staff->salary, 2) }}
                                </p>
                                @if ($staff->advance_payment > 0)
                                    <p class="text-[10px] font-bold text-red-500 mt-1">
                                        Descontar adelanto: -S/{{ number_format($staff->advance_payment, 2) }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="px-4 py-6 text-center">
                            <p class="text-[12px] text-gray-500 font-medium">No hay pagos programados para hoy.</p>
                        </div>
                    @endif
                </div>
                @if ($cantidadAPagar > 0)
                    <div class="p-2 border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-900">
                        <a href="{{ url('/dashboard/staffReport') }}"
                            class="block text-center text-[11px] font-bold text-orange-600 hover:text-orange-700 transition-colors py-1">
                            Ir a Planilla Pago Personal
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- BOTÓN DE NOTIFICACIONES DE STOCK (LA CAMPANITA DE STOCK) --}}
        <div class="relative group/stock-bell flex items-center">
            <button
                class="relative p-2 text-gray-400 hover:text-red-500 transition-all rounded-xl hover:bg-red-50 dark:hover:bg-gray-800">
                <i data-lucide="boxes" class="w-5 h-5"></i>
                {{-- Si hay productos con stock bajo, mostramos el puntito rojo parpadeando --}}
                @if (isset($lowStockItems) && $lowStockItems->count() > 0)
                    <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span
                            class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white dark:border-gray-900"></span>
                    </span>
                @endif
            </button>

            {{-- Menú desplegable de notificaciones de stock --}}
            <div
                class="absolute right-[-70px] sm:right-0 top-[calc(100%+10px)] w-72 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl z-[100] invisible group-hover/stock-bell:visible opacity-0 group-hover/stock-bell:opacity-100 transition-all duration-200 transform origin-top-right scale-95 group-hover/stock-bell:scale-100 overflow-hidden">
                <div
                    class="px-4 py-3 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 flex justify-between items-center">
                    <h3 class="text-[13px] font-black text-gray-800 dark:text-white">Stock Bajo</h3>
                    <span
                        class="text-[10px] font-bold px-2 py-0.5 bg-red-100 text-red-600 rounded-full">{{ isset($lowStockItems) ? $lowStockItems->count() : 0 }}
                        items</span>
                </div>

                <div class="max-h-[300px] overflow-y-auto">
                    @if (isset($lowStockItems) && $lowStockItems->count() > 0)
                        @foreach ($lowStockItems as $item)
                            <div
                                class="px-4 py-3 hover:bg-red-50 dark:hover:bg-gray-800/50 transition-colors border-b border-gray-50 dark:border-gray-800 last:border-0">
                                <p class="text-[12px] font-bold text-gray-800 dark:text-gray-200">
                                    <span class="text-red-600">{{ $item->name }}</span>
                                </p>
                                <p class="text-[11px] text-gray-500 mt-0.5">
                                    Stock actual: <span class="font-bold text-red-500">{{ $item->current_stock }}</span>
                                    {{ $item->unit }}
                                </p>
                                <p class="text-[10px] text-gray-400 mt-1">
                                    Mínimo requerido: {{ $item->minimum_stock }} {{ $item->unit }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <div class="px-4 py-6 text-center">
                            <p class="text-[12px] text-gray-500 font-medium">✓ Todo el stock está en orden.</p>
                        </div>
                    @endif
                </div>
                @if (isset($lowStockItems) && $lowStockItems->count() > 0)
                    <div class="p-2 border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-900">
                        <a href="{{ url('/dashboard/inventory') }}"
                            class="block text-center text-[11px] font-bold text-red-600 hover:text-red-700 transition-colors py-1">
                            Ir a Inventario
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="w-px h-6 bg-gray-200 dark:bg-gray-700 mx-1"></div>

        {{-- Mantenemos el JS original: toggleTheme() --}}
        <div class="flex items-center gap-0.5 sm:gap-1 bg-gray-100 dark:bg-gray-800 rounded-lg px-1 sm:px-2 py-1.5 cursor-pointer select-none"
            onclick="toggleTheme()" title="Cambiar tema">
            <i data-lucide="sun" id="sun-icon" class="w-3.5 h-3.5 text-orange-500"></i>
            <div class="toggle-track mx-0.5">
                <div class="toggle-thumb"></div>
            </div>
            <i data-lucide="moon" id="moon-icon" class="w-3.5 h-3.5 text-gray-400 dark:text-blue-400"></i>
        </div>

        <div class="w-px h-6 bg-gray-200 dark:bg-gray-700"></div>

        <div class="text-right select-none hidden lg:block">
            <p id="clock-time"
                class="font-bold text-[14px] text-gray-800 dark:text-gray-100 tabular-nums leading-none tracking-tight">
            </p>
            <p id="clock-date" class="text-[10px] text-gray-400 dark:text-gray-500 font-medium mt-0.5 leading-none"></p>
        </div>

        <div class="w-px h-6 bg-gray-200 dark:bg-gray-700 hidden lg:block"></div>

        <div class="relative" id="profile-wrap">
            <button
                class="flex items-center gap-1.5 sm:gap-2.5 px-1 sm:px-2.5 py-1.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 cursor-pointer select-none shrink-0"
                onclick="toggleDropdown()">
                <span
                    class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center text-lg bg-gray-100 dark:bg-gray-800 rounded-lg shrink-0">
                    {{ Auth::user()->role_id == 1 ? '🤵‍' : '🧑‍🍳' }}
                </span>
                <div class="text-left hidden md:block">
                    <p class="text-[13px] font-semibold text-gray-800 dark:text-gray-100 leading-none">
                        {{ Auth::user()->staff->name ?? Auth::user()->username }}
                        {{ Auth::user()->staff->surname ?? '' }}
                    </p>
                    <p class="text-[10px] text-gray-400 mt-1 leading-none">
                        {{ Auth::user()->staff->position ?? 'Usuario' }}
                    </p>
                </div>
                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-gray-400 ml-0.5"></i>
            </button>

            <div id="profile-dropdown"
                class="dropdown-menu absolute top-[calc(100%+10px)] right-0 w-56 bg-white dark:bg-gray-900 rounded-2xl shadow-dropdown border border-gray-100 dark:border-gray-800 overflow-hidden z-50">
                <div
                    class="px-4 py-3.5 border-b border-gray-100 dark:border-gray-800 bg-gradient-to-br from-red-50 to-orange-50 dark:from-red-950/20 dark:to-orange-950/20">
                    <p class="text-[13px] font-bold text-gray-800 dark:text-gray-100">
                        {{ Auth::user()->staff->name ?? Auth::user()->username }}
                    </p>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">
                        {{ Auth::user()->staff->email ?? '@' . Auth::user()->username }}
                    </p>
                </div>
                <div class="py-1.5">
                    <a href="{{ route('settings.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 text-[13px] font-medium text-gray-600 dark:text-gray-400 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 transition-colors duration-150">
                        <i data-lucide="settings" class="w-4 h-4 shrink-0"></i>
                        Configuración
                    </a>
                    <div class="mx-3 my-1 h-px bg-gray-100 dark:bg-gray-800"></div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2.5 text-[13px] font-medium text-red-500 hover:bg-red-50 dark:hover:bg-red-950/20 transition-colors duration-150 text-left">
                            <i data-lucide="log-out" class="w-4 h-4 shrink-0"></i>
                            Salir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
