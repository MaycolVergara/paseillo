@extends('layouts.app')

@section('content')

    {{-- ══════════════════════════
         BANNER
    ══════════════════════════ --}}
    <div class="a1 bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 mb-4 overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-orange-400 via-red-500 to-rose-500"></div>
        <div class="p-5 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-orange-400 to-red-600 flex items-center justify-center shadow-md flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    @if(Auth::user()->role_id == 1)
                        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white tracking-tight leading-tight">
                            ¡Buen día, <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">{{ Auth::user()->name }}</span>! 👋
                        </h2>
                    @endif
                    <div class="flex items-center gap-2 mt-0.5">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Resumen de actividad en tiempo real</p>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 px-2 py-0.5 rounded-full border border-emerald-100 dark:border-emerald-900">
            <span class="live-ring"></span>
            En vivo
          </span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <div class="hidden sm:flex items-center gap-1.5 text-xs text-gray-400 bg-gray-50 dark:bg-gray-800 px-3 py-2 rounded-xl border border-gray-100 dark:border-gray-700">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-semibold">{{ now()->translatedFormat('d M Y') }}</span>
                </div>
                <a href="{{ url('/') }}" target="_blank"
                   class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white
                bg-gradient-to-r from-orange-500 to-red-600 shadow-md
                hover:-translate-y-0.5 hover:shadow-orange-200 dark:hover:shadow-orange-900/30
                active:scale-95 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Ver Página Web
                </a>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════
         STATS GRID
    ══════════════════════════ --}}
    <div class="a2 grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3 mb-4">

        {{-- Ventas Hoy — card destacada --}}
        <div class="stat-card col-span-2 sm:col-span-2 lg:col-span-2 relative bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-5 shadow-md overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image:radial-gradient(circle at 75% 25%, #fff 0%, transparent 55%)"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-[10px] font-bold uppercase text-white/80 tracking-wider">Ventas Hoy</p>
                </div>
                <p class="text-3xl font-extrabold text-white leading-none">S/. {{ number_format($totalDay ?? 0, 2) }}</p>
                <p class="text-[10px] text-white/60 mt-1.5 font-medium">Total acumulado</p>
            </div>
        </div>

        {{-- Pedidos --}}
        <div class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-card border border-gray-100/80 dark:border-gray-800">
            <div class="w-8 h-8 bg-blue-50 dark:bg-blue-950/30 rounded-xl flex items-center justify-center mb-2.5">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wide">Pedidos</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white mt-0.5">{{ $ordersToday ?? 0 }}</p>
        </div>

        {{-- Pizzas --}}
        <div class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-card border border-gray-100/80 dark:border-gray-800">
            <div class="text-2xl mb-2">🍕</div>
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wide">Pizzas</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white mt-0.5">{{ $pizzasSold ?? 0 }}</p>
        </div>

        {{-- Hamburguesas --}}
        <div class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-card border border-gray-100/80 dark:border-gray-800">
            <div class="text-2xl mb-2">🍔</div>
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wide">Burgers</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white mt-0.5">{{ $burgersSold ?? 0 }}</p>
        </div>

        {{-- Bebidas --}}
        <div class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-card border border-gray-100/80 dark:border-gray-800">
            <div class="text-2xl mb-2">🥤</div>
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wide">Bebidas</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white mt-0.5">{{ $drinksSold ?? 0 }}</p>
        </div>

        {{-- Krispy --}}
        <div class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-card border border-gray-100/80 dark:border-gray-800">
            <div class="text-2xl mb-2">🍗</div>
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wide">Krispy</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white mt-0.5">{{ $krispySold ?? 0 }}</p>
        </div>

        {{-- Salchipapas --}}
        <div class="stat-card bg-white dark:bg-gray-900 rounded-2xl p-4 shadow-card border border-gray-100/80 dark:border-gray-800">
            <div class="text-2xl mb-2">🍟</div>
            <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wide">Salchipapas</p>
            <p class="text-2xl font-extrabold text-gray-900 dark:text-white mt-0.5">{{ $salchipapasSold ?? 0 }}</p>
        </div>

    </div>

    {{-- ══════════════════════════════════════════════
         FILA: Estado de Mesas (izq) | Más Vendidos (der)
    ══════════════════════════════════════════════ --}}
    <div class="a3 grid grid-cols-1 xl:grid-cols-2 gap-4 mb-4">

        {{-- ─── ESTADO DE MESAS (IZQUIERDA) ─── --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden flex flex-col">

            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 bg-orange-50 dark:bg-orange-950/30 rounded-lg flex items-center justify-center text-base">🪑</span>
                    <div>
                        <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Estado de Mesas</h3>
                        <p class="text-[11px] text-gray-400">Vista del salón en tiempo real</p>
                    </div>
                </div>
                {{-- Leyenda --}}
                <div class="flex items-center gap-3 text-[10px] font-bold">
        <span class="flex items-center gap-1 text-emerald-600">
          <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block"></span> Libre
        </span>
                    <span class="flex items-center gap-1 text-red-500">
          <span class="w-2 h-2 rounded-full bg-red-400 inline-block"></span> Ocupada
        </span>
                </div>
            </div>

            <div class="p-5 grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 xl:grid-cols-5 gap-2.5 flex-1">
                @foreach($tables as $mesa)
                    @php $esOcupada = strtolower($mesa->status) == 'ocupado'; @endphp
                    <div class="mesa-chip rounded-xl p-2.5 text-center border-2
          {{ $esOcupada
            ? 'border-red-200 bg-red-50 dark:bg-red-950/20 dark:border-red-900 text-red-600 dark:text-red-400'
            : 'border-emerald-200 bg-emerald-50 dark:bg-emerald-950/20 dark:border-emerald-900 text-emerald-600 dark:text-emerald-400' }}">
                        <div class="text-xs mb-0.5 opacity-50">{{ $esOcupada ? '👤' : '○' }}</div>
                        <p class="font-extrabold text-lg leading-tight">{{ $mesa->table_number }}</p>
                        <p class="text-[8px] font-bold uppercase tracking-wide opacity-70 mt-0.5">{{ $esOcupada ? 'Ocupada' : 'Libre' }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Footer con barra de ocupación --}}
            @php
                $totalMesas   = count($tables);
                $ocupadas     = collect($tables)->filter(fn($m) => strtolower($m->status) == 'ocupado')->count();
                $libres       = $totalMesas - $ocupadas;
                $pctOcupacion = $totalMesas > 0 ? round(($ocupadas / $totalMesas) * 100) : 0;
            @endphp
            <div class="px-5 py-3 border-t border-gray-100 dark:border-gray-800 bg-gray-50/60 dark:bg-gray-800/20 flex items-center justify-between gap-4">
                <div class="flex gap-4 text-xs font-bold">
                    <span class="text-emerald-600">✓ {{ $libres }} libres</span>
                    <span class="text-red-500">● {{ $ocupadas }} ocupadas</span>
                </div>
                <div class="flex items-center gap-2 min-w-[8rem]">
                    <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                        <div class="bar-animate h-full bg-gradient-to-r from-orange-400 to-red-500 rounded-full"
                             style="width: {{ $pctOcupacion }}%"></div>
                    </div>
                    <span class="text-[10px] font-bold text-gray-500 w-8 text-right">{{ $pctOcupacion }}%</span>
                </div>
            </div>
        </div>

        {{-- ─── MÁS VENDIDOS (DERECHA) ─── --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden flex flex-col">

            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 bg-orange-50 dark:bg-orange-950/30 rounded-lg flex items-center justify-center text-base">🔥</span>
                    <div>
                        <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Más Vendidos</h3>
                        <p class="text-[11px] text-gray-400">Top productos de hoy</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold text-orange-500 bg-orange-50 dark:bg-orange-950/30 px-2.5 py-1 rounded-full border border-orange-100 dark:border-orange-900">HOY</span>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-800 flex-1">
                @forelse($topProducts as $index => $top)
                    <div class="top-row flex items-center gap-3.5 px-5 py-3.5">
                        {{-- Posición top 3 resaltada --}}
                        <div class="w-6 h-6 rounded-lg flex items-center justify-center text-xs font-extrabold flex-shrink-0
            {{ $index === 0 ? 'bg-yellow-400 text-yellow-900'
              : ($index === 1 ? 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300'
              : ($index === 2 ? 'bg-orange-200 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300'
              : 'bg-gray-100 dark:bg-gray-800 text-gray-400')) }}">
                            {{ $index + 1 }}
                        </div>
                        <span class="text-2xl leading-none flex-shrink-0">{{ $top->emoji ?? '🍽️' }}</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-semibold text-gray-800 dark:text-gray-100 truncate">{{ $top->name }}</p>
                            <div class="flex items-center gap-2 mt-1.5">
                                <div class="flex-1 bg-gray-100 dark:bg-gray-800 rounded-full h-2 overflow-hidden">
                                    <div class="bar-animate h-full bg-gradient-to-r {{ $top->colorFondo ?? 'from-orange-400 to-red-500' }} rounded-full"
                                         style="width: {{ $top->porcentaje ?? 0 }}%"></div>
                                </div>
                                <span class="text-[11px] font-extrabold text-gray-500 dark:text-gray-400 flex-shrink-0 w-6 text-right">{{ $top->cantidad ?? 0 }}</span>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold text-gray-400 bg-gray-50 dark:bg-gray-800 px-1.5 py-0.5 rounded-md flex-shrink-0">{{ $top->porcentaje ?? 0 }}%</span>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-14 text-center">
                        <div class="text-4xl mb-2 opacity-30">📊</div>
                        <p class="text-sm text-gray-400 font-medium">Sin ventas registradas aún</p>
                        <p class="text-xs text-gray-300 dark:text-gray-600 mt-1">Los productos aparecerán al registrar pedidos</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ══════════════════════════
         FLUJO DE CAJA
    ══════════════════════════ --}}
    <div class="a4 bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 bg-emerald-50 dark:bg-emerald-950/30 rounded-lg flex items-center justify-center text-base">💰</span>
                <div>
                    <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Flujo de Caja</h3>
                    <p class="text-[10px] text-gray-400">Métodos de pago del día</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-bold uppercase text-gray-400 tracking-wide">Total del día</p>
                <p class="text-2xl font-extrabold gradient-money">S/. {{ number_format($totalDay ?? 0, 2) }}</p>
            </div>
        </div>

        <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">

            {{-- Efectivo --}}
            @php $pctCash = ($totalDay ?? 0) > 0 ? ($cashPayment / $totalDay) * 100 : 0; @endphp
            <div class="bg-emerald-50 dark:bg-emerald-950/20 rounded-2xl p-4 border border-emerald-100 dark:border-emerald-900">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">💵</span>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200">Efectivo</span>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-100 dark:bg-emerald-900/50 px-2 py-0.5 rounded-full">{{ number_format($pctCash, 0) }}%</span>
                </div>
                <p class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3">S/. {{ number_format($cashPayment ?? 0, 2) }}</p>
                <div class="w-full bg-emerald-100 dark:bg-emerald-900/30 rounded-full h-2 overflow-hidden">
                    <div class="bar-animate h-full bg-emerald-500 rounded-full" style="width: {{ $pctCash }}%"></div>
                </div>
            </div>

            {{-- Yape / Plin --}}
            @php $pctYape = ($totalDay ?? 0) > 0 ? ($yapePayment / $totalDay) * 100 : 0; @endphp
            <div class="bg-purple-50 dark:bg-purple-950/20 rounded-2xl p-4 border border-purple-100 dark:border-purple-900">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">📱</span>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200">Yape / Plin</span>
                    </div>
                    <span class="text-xs font-bold text-purple-600 bg-purple-100 dark:bg-purple-900/50 px-2 py-0.5 rounded-full">{{ number_format($pctYape, 0) }}%</span>
                </div>
                <p class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3">S/. {{ number_format($yapePayment ?? 0, 2) }}</p>
                <div class="w-full bg-purple-100 dark:bg-purple-900/30 rounded-full h-2 overflow-hidden">
                    <div class="bar-animate h-full bg-purple-500 rounded-full" style="width: {{ $pctYape }}%"></div>
                </div>
            </div>

            {{-- Tarjeta --}}
            @php $pctCard = ($totalDay ?? 0) > 0 ? ($cardPayment / $totalDay) * 100 : 0; @endphp
            <div class="bg-blue-50 dark:bg-blue-950/20 rounded-2xl p-4 border border-blue-100 dark:border-blue-900">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">💳</span>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200">Tarjeta</span>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-100 dark:bg-blue-900/50 px-2 py-0.5 rounded-full">{{ number_format($pctCard, 0) }}%</span>
                </div>
                <p class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3">S/. {{ number_format($cardPayment ?? 0, 2) }}</p>
                <div class="w-full bg-blue-100 dark:bg-blue-900/30 rounded-full h-2 overflow-hidden">
                    <div class="bar-animate h-full bg-blue-500 rounded-full" style="width: {{ $pctCard }}%"></div>
                </div>
            </div>

        </div>
    </div>

@endsection
