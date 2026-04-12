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
                        @if (Auth::user()->role_id == 1)
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
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ now()->translatedFormat('d M Y') }}
                    </div>
                    <a href="{{ url('/') }}" target="_blank"
                        class="group flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-gray-900 to-gray-800 dark:from-orange-500 dark:to-red-600 shadow-md hover:shadow-xl transition-all duration-300 active:scale-95">
                        <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.l"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Ver Menú Web
                    </a>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════
             2. STATS GRID (Tarjetas)
        ══════════════════════════ --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-4 lg:gap-5">
            {{-- Ventas Hoy (Tarjeta Hero) --}}
            <div
                class="col-span-2 relative bg-gradient-to-br from-orange-500 via-red-500 to-rose-600 rounded-3xl p-6 shadow-lg shadow-orange-500/20 overflow-hidden group">
                <div
                    class="absolute -right-10 -top-10 w-40 h-40 bg-white/20 blur-3xl rounded-full group-hover:scale-150 transition-transform duration-700">
                </div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 blur-2xl rounded-full"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-[11px] font-black uppercase text-white/90 tracking-widest">Ingresos Hoy</p>
                    </div>
                    <div>
                        <p class="text-4xl font-black text-white tracking-tighter drop-shadow-sm">
                            <span class="text-2xl font-bold opacity-80 mr-1">S/</span>{{ number_format($totalDay ?? 0, 2) }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- Pedidos --}}
            <div
                class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-5 shadow-lg shadow-slate-900/20 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300 group">
                <div
                    class="absolute -right-6 -top-6 w-20 h-20 bg-blue-500/20 blur-2xl rounded-full group-hover:bg-blue-400/30 transition-colors duration-500">
                </div>
                <div class="relative z-10">
                    <div
                        class="w-10 h-10 bg-blue-500/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Pedidos</p>
                    <p class="text-2xl font-black text-white mt-1">{{ $ordersToday ?? 0 }}</p>
                </div>
            </div>
            {{-- Mini Cards de Productos con diseño premium --}}
            @php
                $miniStats = [
                    [
                        'icon' => '🍕',
                        'name' => 'Pizzas',
                        'val' => $pizzasSold,
                        'from' => 'from-red-500',
                        'to' => 'to-orange-400',
                        'glow' => 'shadow-red-500/20',
                        'accent' => 'bg-red-400/20',
                        'text' => 'text-red-300',
                    ],
                    [
                        'icon' => '🍔',
                        'name' => 'Burgers',
                        'val' => $burgersSold,
                        'from' => 'from-amber-500',
                        'to' => 'to-yellow-400',
                        'glow' => 'shadow-amber-500/20',
                        'accent' => 'bg-amber-400/20',
                        'text' => 'text-amber-300',
                    ],
                    [
                        'icon' => '🥤',
                        'name' => 'Bebidas',
                        'val' => $drinksSold,
                        'from' => 'from-cyan-500',
                        'to' => 'to-blue-400',
                        'glow' => 'shadow-cyan-500/20',
                        'accent' => 'bg-cyan-400/20',
                        'text' => 'text-cyan-300',
                    ],
                    [
                        'icon' => '🍗',
                        'name' => 'Krispy',
                        'val' => $krispySold,
                        'from' => 'from-orange-600',
                        'to' => 'to-red-500',
                        'glow' => 'shadow-orange-500/20',
                        'accent' => 'bg-orange-400/20',
                        'text' => 'text-orange-300',
                    ],
                ];
            @endphp
            @foreach ($miniStats as $stat)
                <div
                    class="relative bg-gradient-to-br {{ $stat['from'] }} {{ $stat['to'] }} rounded-3xl p-5 shadow-lg {{ $stat['glow'] }} overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <div
                        class="absolute -right-4 -bottom-4 w-16 h-16 bg-white/10 blur-xl rounded-full group-hover:scale-150 transition-transform duration-500">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <div
                                class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                                <span
                                    class="text-xl group-hover:scale-110 transition-transform inline-block">{{ $stat['icon'] }}</span>
                            </div>
                        </div>
                        <p class="text-[10px] font-bold uppercase text-white/80 tracking-widest">{{ $stat['name'] }}</p>
                        <p class="text-2xl font-black text-white mt-1 drop-shadow-sm">{{ $stat['val'] ?? 0 }}</p>
                    </div>
                </div>
            @endforeach
        </div>


        {{-- ══════════════════════════════════════════════
             2.5. GRÁFICOS Y SALUD FINANCIERA
        ══════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-6 items-start">
            {{-- Panel Gráfico (Toma 2 columnas en pantallas grandes) --}}
            <div
                class="xl:col-span-2 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 p-6 flex flex-col h-full">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-extrabold text-[16px] text-gray-900 dark:text-gray-100">Tendencia de Ventas</h3>
                        <p class="text-xs font-medium text-gray-400 mt-0.5">Últimos 7 días (Ingresos diarios)</p>
                    </div>
                </div>
                <div class="flex-1 w-full min-h-[250px] relative">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            {{-- Panel Salud Financiera --}}
            <div
                class="xl:col-span-1 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 p-6 flex flex-col h-full relative overflow-hidden">

                <h3 class="font-extrabold text-[16px] text-gray-900 dark:text-gray-100 relative z-10">Salud Financiera</h3>
                <p class="text-xs font-medium text-gray-400 mt-0.5 relative z-10">Análisis del mes en curso</p>

                <div class="mt-6 space-y-5 relative z-10">
                    {{-- Ingresos --}}
                    <div>
                        <div class="flex justify-between items-end mb-1">
                            <span class="text-xs font-black text-gray-500 uppercase tracking-widest">Ingresos Brutos</span>
                            <span class="text-lg font-black text-emerald-500">S/ {{ number_format($salesMonth, 2) }}</span>
                        </div>
                    </div>

                    {{-- Nómina --}}
                    <div>
                        <div class="flex justify-between items-end mb-1">
                            <span class="text-xs font-black text-gray-500 uppercase tracking-widest">Costos de
                                Planilla</span>
                            <span class="text-lg font-black text-rose-500">S/ {{ number_format($totalPayroll, 2) }}</span>
                        </div>
                        @php
                            $payrollPct = $salesMonth > 0 ? min(($totalPayroll / $salesMonth) * 100, 100) : 100;
                        @endphp
                        <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2 overflow-hidden flex">
                            <div class="bg-rose-500 h-full rounded-full transition-all duration-1000"
                                style="width: {{ $payrollPct }}%"></div>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-800 my-2">

                    {{-- Utilidad Bruta --}}
                    @php $utilidadBruta = $salesMonth - $totalPayroll; @endphp
                    <div>
                        <span class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-1">Ganancia
                            Estimada</span>
                        <div class="flex items-center gap-2">
                            <span
                                class="text-3xl font-black {{ $utilidadBruta >= 0 ? 'text-gray-900 dark:text-white' : 'text-red-500' }} tracking-tighter">
                                S/ {{ number_format($utilidadBruta, 2) }}
                            </span>
                            @if ($utilidadBruta > 0)
                                <span
                                    class="bg-emerald-100 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400 text-[10px] px-2 py-0.5 rounded-md font-bold">+
                                    Positivo</span>
                            @else
                                <span
                                    class="bg-rose-100 text-rose-600 dark:bg-rose-500/20 dark:text-rose-400 text-[10px] px-2 py-0.5 rounded-md font-bold">Pérdida</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════
             3. MESAS Y TOP VENTAS
        ══════════════════════════════════════════════ --}}

        {{-- ══════════════════════════════════════════════
            MESAS SALON
       ══════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-5 lg:gap-6 items-start">

            {{-- Panel Mesas --}}
            <div
                class="xl:col-span-3 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 flex flex-col overflow-hidden">

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

                <div
                    class="p-4 grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 xl:grid-cols-12 gap-2 sm:gap-3">
                    @foreach ($tables as $table)
                        <button
                            class="relative aspect-square flex flex-col items-center justify-center gap-0.5 sm:gap-1 rounded-xl border-2 hover:-translate-y-0.5 transition-all duration-300
                           {{ $table->status == 'disponible'
                               ? 'border-emerald-100 bg-emerald-50/50 text-emerald-600 hover:shadow-md hover:shadow-emerald-500/20'
                               : 'border-rose-100 bg-rose-50/50 text-rose-600 hover:shadow-md hover:shadow-rose-500/20' }}">
                            <span class="font-black tracking-tighter leading-none"
                                style="font-size: clamp(14px, 4vw, 24px);">{{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="font-black uppercase tracking-widest opacity-70 leading-none"
                                style="font-size: clamp(6px, 1.5vw, 8px);">{{ $table->status }}</span>
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
                            <div
                                class="w-7 h-7 rounded-xl flex items-center justify-center text-[12px] font-black flex-shrink-0 shadow-sm
                            {{ $index === 0
                                ? 'bg-gradient-to-br from-yellow-300 to-amber-500 text-amber-950'
                                : ($index === 1
                                    ? 'bg-gradient-to-br from-gray-200 to-gray-400 text-gray-800'
                                    : ($index === 2
                                        ? 'bg-gradient-to-br from-orange-300 to-orange-600 text-white'
                                        : 'bg-gray-100 dark:bg-gray-800 text-gray-500')) }}">
                                {{ $index + 1 }}
                            </div>
                            <div class="text-2xl flex-shrink-0 group-hover:scale-110 transition-transform">
                                {{ $top->emoji ?? '🍽️' }}</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-end mb-1.5">
                                    <p class="text-[13px] font-bold text-gray-800 dark:text-gray-200 truncate">
                                        {{ $top->name }}</p>
                                    <span
                                        class="text-[11px] font-black text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 px-2 py-0.5 rounded border border-gray-100 dark:border-gray-700 shadow-sm">{{ $top->quantity ?? 0 }}
                                        u.</span>
                                </div>
                                <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r {{ $top->colorFondo ?? 'from-orange-400 to-red-500' }} rounded-full"
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
             MESAS DELIVERY + FLUJO DE CAJA
        ══════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-5 lg:gap-6 items-start">

            {{-- Panel Delivery --}}
            <div
                class="xl:col-span-3 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 flex flex-col overflow-hidden">
                <div class="px-7 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-[16px] text-gray-900 dark:text-gray-100">Estado Delivery</h3>
                        <p class="text-xs font-medium text-gray-400 mt-0.5">Control de pedidos delivery en tiempo real</p>
                    </div>

                    <div
                        class="flex items-center gap-4 text-[11px] font-bold bg-gray-50 dark:bg-gray-800/50 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                        <span class="flex items-center gap-1.5 text-rose-500 dark:text-rose-400">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-[0_0_8px_#f43f5e]"></span>
                            {{ $tableDelivery->where('status', 'disponible')->count() }} Libres
                        </span>
                        <span class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                            {{ $tableDelivery->where('status', 'ocupado')->count() }} Ocupadas
                        </span>
                    </div>
                </div>

                <div
                    class="p-4 grid grid-cols-[repeat(auto-fill,minmax(70px,1fr))] sm:grid-cols-[repeat(auto-fill,minmax(80px,1fr))] gap-4 sm:gap-5">
                    @foreach ($tableDelivery as $table)
                        <button
                            class="relative aspect-square flex flex-col items-center justify-center gap-1 rounded-xl border-2 hover:-translate-y-0.5 transition-all duration-300
                            {{ $table->status == 'disponible'
                                ? 'border-red-400 bg-red-100 text-red-700'
                                : 'border-red-800 bg-red-900 text-white' }}">
                            <span class="font-black tracking-tighter leading-none"
                                style="font-size: clamp(12px, 2vw, 22px);">
                                {{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="font-black uppercase tracking-widest opacity-80 leading-none"
                                style="font-size: 8px;">
                                {{ $table->status }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Panel Flujo de Caja --}}
            <div
                class="xl:col-span-1 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-400 via-purple-400 to-blue-500">
                </div>

                {{-- Header compacto --}}
                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-[13px] text-gray-900 dark:text-gray-100">Flujo de Caja</h3>
                        <p class="text-[10px] font-medium text-gray-400">Ingresos por método de pago</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] font-black uppercase text-gray-400 tracking-widest">Cierre</p>
                        <p class="text-base font-black text-gray-900 dark:text-white tracking-tighter">
                            <span
                                class="text-xs font-bold text-gray-400 mr-0.5">S/</span>{{ number_format($totalDay ?? 0, 2) }}
                        </p>
                    </div>
                </div>

                {{-- 3 cards en fila horizontal --}}
                <div class="p-3 grid grid-cols-1 sm:grid-cols-3 gap-3">

                    {{-- Efectivo --}}
                    @php $pctCash = ($totalDay ?? 0) > 0 ? ($cashPayment / $totalDay) * 100 : 0; @endphp
                    <div
                        class="bg-emerald-50/60 dark:bg-emerald-900/10 rounded-2xl p-4 border border-emerald-100 dark:border-emerald-800/30 flex flex-col gap-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-base">💵</span>
                            <span class="text-[10px] font-black text-emerald-600">{{ number_format($pctCash, 0) }}%</span>
                        </div>
                        <p class="text-[10px] font-bold text-gray-500 dark:text-gray-400">Efectivo</p>
                        <p class="text-[13px] font-black text-gray-900 dark:text-white tracking-tighter leading-none">S/
                            {{ number_format($cashPayment ?? 0, 2) }}</p>
                        <div class="w-full bg-gray-200/60 dark:bg-gray-700 rounded-full h-1 overflow-hidden">
                            <div class="h-full bg-emerald-400 rounded-full" style="width: {{ $pctCash }}%"></div>
                        </div>
                    </div>

                    {{-- Billeteras --}}
                    @php
                        $digitalTotal = $yapePayment ?? 0;
                        $pctDigital = ($totalDay ?? 0) > 0 ? ($digitalTotal / $totalDay) * 100 : 0;
                    @endphp
                    <div
                        class="bg-purple-50/60 dark:bg-purple-900/10 rounded-2xl p-3 border border-purple-100 dark:border-purple-800/30 flex flex-col gap-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-base">📱</span>
                            <span
                                class="text-[10px] font-black text-purple-600">{{ number_format($pctDigital, 0) }}%</span>
                        </div>
                        <p class="text-[10px] font-bold text-gray-500 dark:text-gray-400">Yape</p>
                        <p class="text-[13px] font-black text-gray-900 dark:text-white tracking-tighter leading-none">S/
                            {{ number_format($digitalTotal, 2) }}</p>
                        <div class="w-full bg-gray-200/60 dark:bg-gray-700 rounded-full h-1 overflow-hidden">
                            <div class="h-full bg-purple-400 rounded-full" style="width: {{ $pctDigital }}%"></div>
                        </div>

                    </div>

                    {{-- Tarjeta --}}
                    @php $pctCard = ($totalDay ?? 0) > 0 ? ($cardPayment / $totalDay) * 100 : 0; @endphp
                    <div
                        class="bg-blue-50/60 dark:bg-blue-900/10 rounded-2xl p-3 border border-blue-100 dark:border-blue-800/30 flex flex-col gap-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-base">💳</span>
                            <span class="text-[10px] font-black text-blue-600">{{ number_format($pctCard, 0) }}%</span>
                        </div>
                        <p class="text-[10px] font-bold text-gray-500 dark:text-gray-400">Tarjeta</p>
                        <p class="text-[13px] font-black text-gray-900 dark:text-white tracking-tighter leading-none">S/
                            {{ number_format($cardPayment ?? 0, 2) }}</p>
                        <div class="w-full bg-gray-200/60 dark:bg-gray-700 rounded-full h-1 overflow-hidden">
                            <div class="h-full bg-blue-400 rounded-full" style="width: {{ $pctCard }}%"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById('salesChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');

            // Definiendo el gradiente (efecto area chart premium)
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(249, 115, 22, 0.4)'); // orange-500 opaco
            gradient.addColorStop(1, 'rgba(249, 115, 22, 0.0)');

            const labels = {!! json_encode($chartLabels) !!};
            const data = {!! json_encode($chartData) !!};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ingresos Brutos',
                        data: data,
                        borderColor: '#f97316', // orange-500
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#ea580c',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.4 // Hace las curvas fluidas y profesionales
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            padding: 12,
                            titleFont: {
                                size: 13
                            },
                            bodyFont: {
                                size: 15,
                                weight: 'bold'
                            },
                            callbacks: {
                                label: function(context) {
                                    return ' S/ ' + context.parsed.y.toFixed(2);
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#9ca3af',
                                font: {
                                    size: 11,
                                    weight: '600'
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(229, 231, 235, 0.5)',
                                drawBorder: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                color: '#9ca3af',
                                font: {
                                    size: 11
                                },
                                callback: function(value) {
                                    return 'S/ ' + value;
                                }
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
