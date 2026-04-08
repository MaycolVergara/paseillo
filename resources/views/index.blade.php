@extends('layouts.app')

@section('content')

    <div class="space-y-6"> {{-- Contenedor principal con espaciado uniforme --}}

        {{-- ══════════════════════════
             1. BANNER PREMIUM
        ══════════════════════════ --}}
        <div
            class="relative bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/50 dark:border-gray-800 overflow-hidden">
            {{-- Línea de acento superior --}}
            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-orange-400 via-red-500 to-rose-600"></div>

            <div class="px-7 py-6 flex flex-col sm:flex-row justify-between sm:items-center gap-5 relative z-10">
                <div class="flex items-center gap-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-100 to-red-50 dark:from-gray-800 dark:to-gray-800 border border-orange-200/50 dark:border-gray-700 flex items-center justify-center shadow-inner flex-shrink-0">
                        <span class="text-3xl">🍔</span>
                    </div>
                    <div>
                        @if(Auth::user()->role_id == 1)
                            <h2 class="text-xl md:text-2xl font-black text-gray-900 dark:text-white tracking-tight">
                                ¡Buen día, <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">{{ Auth::user()->name }}</span>!
                                👋
                            </h2>
                        @endif
                        <div class="flex items-center gap-2 mt-1">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest">
                                Panel en vivo</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 flex-shrink-0">
                    <div
                        class="hidden md:flex items-center gap-2 text-xs font-bold text-gray-500 dark:text-gray-400 bg-gray-50/80 dark:bg-gray-800/80 px-4 py-2.5 rounded-xl border border-gray-100 dark:border-gray-700">
                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ now()->translatedFormat('d M Y') }}
                    </div>
                    <a href="{{ url('/') }}" target="_blank"
                       class="group flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-gray-900 to-gray-800 dark:from-orange-500 dark:to-red-600 shadow-md hover:shadow-xl transition-all duration-300 active:scale-95">
                        <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.l"
                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Ver Menú Web
                    </a>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════
             2. STATS GRID (Tarjetas)
        ══════════════════════════ --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 lg:gap-5">

            {{-- Ventas Hoy (Tarjeta Hero) --}}
            <div
                class="col-span-2 relative bg-gradient-to-br from-orange-500 via-red-500 to-rose-600 rounded-3xl p-6 shadow-lg shadow-orange-500/20 overflow-hidden group">
                <div
                    class="absolute -right-10 -top-10 w-40 h-40 bg-white/20 blur-3xl rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-[11px] font-black uppercase text-white/90 tracking-widest">Ingresos Hoy</p>
                    </div>
                    <div>
                        <p class="text-4xl font-black text-white tracking-tighter drop-shadow-sm">
                            <span
                                class="text-2xl font-bold opacity-80 mr-1">S/</span>{{ number_format($totalDay ?? 0, 2) }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Pedidos --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-3xl p-5 shadow-sm border border-gray-100 dark:border-gray-800 hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                <div
                    class="w-10 h-10 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center mb-3 text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Pedidos</p>
                <p class="text-2xl font-black text-gray-900 dark:text-white mt-1">{{ $ordersToday ?? 0 }}</p>
            </div>

            {{-- Mini Cards de Productos --}}
            @php
                $miniStats = [
                    ['icon' => '🍕', 'name' => 'Pizzas', 'val' => $pizzasSold],
                    ['icon' => '🍔', 'name' => 'Burgers', 'val' => $burgersSold],
                    ['icon' => '🥤', 'name' => 'Bebidas', 'val' => $drinksSold],
                    ['icon' => '🍗', 'name' => 'Krispy', 'val' => $krispySold],
                ];
            @endphp

            @foreach($miniStats as $stat)
                <div
                    class="bg-white dark:bg-gray-900 rounded-3xl p-5 shadow-sm border border-gray-100 dark:border-gray-800 hover:-translate-y-1 hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                    <div class="text-2xl mb-2">{{ $stat['icon'] }}</div>
                    <div>
                        <p class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">{{ $stat['name'] }}</p>
                        <p class="text-2xl font-black text-gray-900 dark:text-white mt-1">{{ $stat['val'] ?? 0 }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ══════════════════════════════════════════════
             3. MESAS Y TOP VENTAS
        ══════════════════════════════════════════════ --}}

        {{-- ══════════════════════════════════════════════
            MESAS SALON
       ══════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-6">

            {{-- Panel Mesas --}}
            <div
                class="xl:col-span-2 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 flex flex-col">

                <div class="px-7 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-[16px] text-gray-900 dark:text-gray-100">Estado del Salón</h3>
                        <p class="text-xs font-medium text-gray-400 mt-0.5">Control de mesas en tiempo real</p>
                    </div>
                    <div
                        class="flex items-center gap-4 text-[11px] font-bold bg-gray-50 dark:bg-gray-800/50 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                        <span class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_8px_#34d399]"></span>
                            {{ $tables->where('status', 'disponible')->count() }} Libre
                        </span>
                                    <span class="flex items-center gap-1.5 text-rose-500 dark:text-rose-400">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-[0_0_8px_#f43f5e]"></span>
                            {{ $tables->where('status', 'ocupado')->count() }} Ocupada
                        </span>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 xl:grid-cols-5 gap-4">
                    @foreach($tables as $table)
                        <button class="relative aspect-square flex flex-col items-center justify-center gap-1.5 p-2 rounded-2xl border-2 hover:-translate-y-1 transition-all duration-300
                           {{ $table->status == 'disponible'
                              ? 'border-emerald-100 bg-emerald-50/50 text-emerald-600 hover:shadow-lg hover:shadow-emerald-500/20'
                              : 'border-rose-100 bg-rose-50/50 text-rose-600 hover:shadow-lg hover:shadow-rose-500/20' }}">
                                <span
                                    class="text-3xl font-black tracking-tighter">{{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}</span>
                                <span
                                    class="text-[9px] font-black uppercase tracking-widest opacity-80">{{ $table->status }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Panel Top Ventas --}}
            <div
                class="xl:col-span-1 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 flex flex-col relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-orange-400 to-red-500"></div>
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-[15px] text-gray-900 dark:text-gray-100">Top Ventas</h3>
                        <p class="text-xs font-medium text-gray-400 mt-0.5">Favoritos del menú</p>
                    </div>
                    <span
                        class="text-[10px] font-black text-orange-600 bg-orange-100/80 dark:bg-orange-900/30 px-2.5 py-1 rounded-md uppercase tracking-widest">HOY</span>
                </div>

                <div class="flex-1 p-3 space-y-1 overflow-y-auto">
                    @forelse($topProducts as $index => $top)
                        <div
                            class="group flex items-center gap-4 px-3 py-3.5 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <div class="w-7 h-7 rounded-xl flex items-center justify-center text-[12px] font-black flex-shrink-0 shadow-sm
                            {{ $index === 0 ? 'bg-gradient-to-br from-yellow-300 to-amber-500 text-amber-950' :
                              ($index === 1 ? 'bg-gradient-to-br from-gray-200 to-gray-400 text-gray-800' :
                              ($index === 2 ? 'bg-gradient-to-br from-orange-300 to-orange-600 text-white' :
                              'bg-gray-100 dark:bg-gray-800 text-gray-500')) }}">
                                {{ $index + 1 }}
                            </div>
                            <div
                                class="text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">{{ $top->emoji ?? '🍽️' }}</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-end mb-1.5">
                                    <p class="text-[13px] font-bold text-gray-800 dark:text-gray-200 truncate">{{ $top->name }}</p>
                                    <span
                                        class="text-[11px] font-black text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 px-2 py-0.5 rounded border border-gray-100 dark:border-gray-700 shadow-sm">{{ $top->quantity ?? 0 }} u.</span>
                                </div>
                                <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-1.5 overflow-hidden">
                                    <div
                                        class="h-full bg-gradient-to-r {{ $top->colorFondo ?? 'from-orange-400 to-red-500' }} rounded-full"
                                        style="width: {{ $top->percentage ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <span class="text-4xl opacity-30 mb-3">📊</span>
                            <p class="text-sm font-bold text-gray-500">Aún no hay ventas</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>


        {{-- ══════════════════════════════════════════════
             MESAS DELIVERY
        ══════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-6">

            {{-- Panel Mesas --}}
            <div class="xl:col-span-2 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 flex flex-col">
                <div class="px-7 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-[16px] text-gray-900 dark:text-gray-100">Estado del Salón</h3>
                        <p class="text-xs font-medium text-gray-400 mt-0.5">Control de mesas en tiempo real</p>
                    </div>

                    <div class="flex items-center gap-4 text-[11px] font-bold bg-gray-50 dark:bg-gray-800/50 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">

                        <span  class="flex items-center gap-1.5 text-rose-500 dark:text-rose-400">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-[0_0_8px_#f43f5e]"></span>
                            {{ $tableDelivery->where('status', 'disponible')->count() }} Libres
                         </span>

                        <span class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                            {{ $tableDelivery->where('status', 'ocupado')->count() }} Ocupadas
                        </span>
                    </div>
                </div>

                {{-- Grid ajustado a 5 columnas en XL --}}
                <div class="p-6 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 xl:grid-cols-5 gap-4">
                    @foreach($tableDelivery as $table)
                        <button
                            class="relative aspect-square flex flex-col items-center justify-center gap-1.5 p-2 rounded-2xl border-2 hover:-translate-y-1 transition-all duration-300 shadow-sm
                            {{ $table->status == 'disponible' ? 'border-red-400 bg-red-100 text-red-700' :
                                    'border-red-800 bg-red-900 text-white' }} hover:scale-105 transition-all shadow-xl">

                            <span class="text-3xl font-black tracking-tighter">
                                {{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}
                            </span>
                                        <span class="text-[9px] font-black uppercase tracking-widest opacity-80">
                                {{ $table->status }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>

        </div>


        {{-- ══════════════════════════
             4. FLUJO DE CAJA (Premium)
        ══════════════════════════ --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 relative overflow-hidden">
            <div
                class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-400 via-purple-400 to-blue-500"></div>

            <div class="px-7 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                <div>
                    <h3 class="font-extrabold text-[16px] text-gray-900 dark:text-gray-100">Flujo de Caja</h3>
                    <p class="text-xs font-medium text-gray-400 mt-0.5">Ingresos según método de pago</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Cierre del día</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white tracking-tighter">
                        <span
                            class="text-base font-bold text-gray-400 mr-1">S/</span>{{ number_format($totalDay ?? 0, 2) }}
                    </p>
                </div>
            </div>

            <div class="p-7 grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Efectivo --}}
                @php $pctCash = ($totalDay ?? 0) > 0 ? ($cashPayment / $totalDay) * 100 : 0; @endphp
                <div
                    class="group relative bg-white dark:bg-gray-800/40 rounded-3xl p-6 border border-gray-100 dark:border-gray-700/50 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl group-hover:bg-emerald-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-xl border border-emerald-100 dark:border-emerald-800/50">
                                    💵
                                </div>
                                <span class="text-[14px] font-bold text-gray-700 dark:text-gray-200">Efectivo</span>
                            </div>
                            <span
                                class="text-[12px] font-black text-emerald-600 bg-emerald-50 dark:bg-emerald-900/40 px-2.5 py-1 rounded-lg">{{ number_format($pctCash, 0) }}%</span>
                        </div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white mb-4 tracking-tighter"><span
                                class="text-base font-semibold text-gray-400 mr-1">S/</span>{{ number_format($cashPayment ?? 0, 2) }}
                        </p>
                        <div
                            class="w-full bg-gray-100 dark:bg-gray-700/50 rounded-full h-2 overflow-hidden shadow-inner">
                            <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full relative"
                                 style="width: {{ $pctCash }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Yape/Plin --}}
                @php
                    $digitalTotal = ($yapePayment ?? 0) + ($plinPayment ?? 0);
                    $pctDigital = ($totalDay ?? 0) > 0 ? ($digitalTotal / $totalDay) * 100 : 0;
                @endphp
                <div
                    class="group relative bg-white dark:bg-gray-800/40 rounded-3xl p-6 border border-gray-100 dark:border-gray-700/50 hover:shadow-xl hover:shadow-purple-500/5 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute -right-10 -top-10 w-32 h-32 bg-purple-500/10 rounded-full blur-3xl group-hover:bg-purple-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center text-xl border border-purple-100 dark:border-purple-800/50">
                                    📱
                                </div>
                                <span class="text-[14px] font-bold text-gray-700 dark:text-gray-200">Billeteras</span>
                            </div>
                            <span
                                class="text-[12px] font-black text-purple-600 bg-purple-50 dark:bg-purple-900/40 px-2.5 py-1 rounded-lg">{{ number_format($pctDigital, 0) }}%</span>
                        </div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white mb-3 tracking-tighter"><span
                                class="text-base font-semibold text-gray-400 mr-1">S/</span>{{ number_format($digitalTotal, 2) }}
                        </p>

                        <div
                            class="flex justify-between items-center text-[11px] font-bold text-gray-500 dark:text-gray-400 mb-2">
                            <span class="flex items-center gap-1.5"><span
                                    class="w-2 h-2 rounded-full bg-[#00BFA5]"></span>Yape: {{ number_format($yapePayment ?? 0, 2) }}</span>
                            <span class="flex items-center gap-1.5"><span
                                    class="w-2 h-2 rounded-full bg-[#FF0050]"></span>Plin: {{ number_format($plinPayment ?? 0, 2) }}</span>
                        </div>
                        <div
                            class="w-full bg-gray-100 dark:bg-gray-700/50 rounded-full h-2 overflow-hidden shadow-inner">
                            <div class="h-full bg-gradient-to-r from-purple-400 to-purple-500 rounded-full relative"
                                 style="width: {{ $pctDigital }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Tarjeta --}}
                @php $pctCard = ($totalDay ?? 0) > 0 ? ($cardPayment / $totalDay) * 100 : 0; @endphp
                <div
                    class="group relative bg-white dark:bg-gray-800/40 rounded-3xl p-6 border border-gray-100 dark:border-gray-700/50 hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute -right-10 -top-10 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-xl border border-blue-100 dark:border-blue-800/50">
                                    💳
                                </div>
                                <span
                                    class="text-[14px] font-bold text-gray-700 dark:text-gray-200">Tarjeta (POS)</span>
                            </div>
                            <span
                                class="text-[12px] font-black text-blue-600 bg-blue-50 dark:bg-blue-900/40 px-2.5 py-1 rounded-lg">{{ number_format($pctCard, 0) }}%</span>
                        </div>
                        <p class="text-3xl font-black text-gray-900 dark:text-white mb-4 tracking-tighter"><span
                                class="text-base font-semibold text-gray-400 mr-1">S/</span>{{ number_format($cardPayment ?? 0, 2) }}
                        </p>
                        <div
                            class="w-full bg-gray-100 dark:bg-gray-700/50 rounded-full h-2 overflow-hidden shadow-inner">
                            <div class="h-full bg-gradient-to-r from-blue-400 to-blue-500 rounded-full relative"
                                 style="width: {{ $pctCard }}%"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
