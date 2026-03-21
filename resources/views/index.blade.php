@extends('layouts.app')

@section('content')

    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-3">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">

            {{-- Lado Izquierdo: Textos --}}
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    {{-- Cambiado: rol -> role_id y nombre -> name --}}
                    @if(Auth::user()->role_id == 1)
                        ¡Buen día, Admin {{ Auth::user()->name }}! 👋
                    @endif
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Aquí tienes un resumen de lo que está pasando hoy.
                    <span class="inline-flex items-center gap-1 ml-2 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 px-2 py-0.5 rounded-full">
                    <span class="pulse-dot w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                    En vivo
                </span>
                </p>
            </div>

            {{-- Lado Derecho: Botón --}}
            <div class="flex shrink-0 items-center">
                <a href="{{ url('/') }}" target="_blank"
                   class="whitespace-nowrap flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:shadow-orange-500/40 shadow-lg transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    Ver la Página Web
                </a>
            </div>

        </div>
    </div>

    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        {{-- Tarjeta: Ventas Hoy --}}
        <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-red-500 to-orange-400 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Ventas Hoy</p>
                    {{-- Cambiado: totalDia -> totalDay --}}
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">
                        S/. {{ number_format($totalDay, 2) }}
                    </p>
                    <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 mt-2 flex items-center gap-1">
                        +14.2% vs ayer
                    </p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-100 to-orange-100 dark:from-red-950/40 dark:to-orange-950/40 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    💰
                </div>
            </div>
        </div>

        {{-- Tarjeta: Pedidos Totales --}}
        <div class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-orange-400 to-amber-400 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Pedidos Mesas</p>
                    {{-- Cambiado: pedidosHoy -> ordersToday --}}
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $ordersToday }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    🧾
                </div>
            </div>
        </div>

        {{-- Tarjetas de Comida (Pizzas, Burgers, etc) - Variables actualizadas --}}
        <div class="animate-in delay-3 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-rose-400 to-pink-500 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Pizzas</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $pizzasSold }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-rose-50 dark:bg-rose-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">🍕</div>
            </div>
        </div>

        <div class="animate-in delay-4 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-amber-500 to-yellow-400 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Hamburguesas</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $burgersSold }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">🍔</div>
            </div>
        </div>

        {{-- Repite la misma lógica para Bebidas ($drinksSold), Krispy ($krispySold), Salchipapas ($salchipapasSold) --}}
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-4">
        {{-- Estado de Mesas --}}
        <div class="xl:col-span-2 animate-in delay-5 bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden flex flex-col">
            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800">
                <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Estado de Mesas</h3>
            </div>
            <div class="p-5 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                @foreach($tables as $table)
                    @php
                        // Cambiado: estado -> status y numero_mesa -> table_number
                        $isOccupied = strtolower($table->status) == 'ocupada';
                        $colorClass = $isOccupied
                            ? 'border-red-200 bg-red-50 text-red-600 dark:bg-red-950/20 dark:border-red-900'
                            : 'border-emerald-200 bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:border-emerald-900';
                        $statusText = $isOccupied ? 'Ocupada' : 'Libre';
                    @endphp
                    <div class="cursor-pointer rounded-xl p-3 text-center border-2 {{ $colorClass }} hover:scale-105 transition-all shadow-sm">
                        <p class="font-extrabold text-xl">{{ $table->table_number }}</p>
                        <p class="text-[9px] font-bold mt-1 uppercase tracking-wide">{{ $statusText }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Más Vendidos --}}
        <div class="animate-in delay-6 bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800">
                <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Más Vendidos</h3>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse($topProducts as $index => $top)
                    <div class="flex items-center gap-3.5 px-5 py-3.5">
                        <span class="font-extrabold text-sm w-5 text-center">{{ $index + 1 }}</span>
                        <span class="text-2xl leading-none">{{ $top->emoji }}</span>
                        <div class="flex-1 min-w-0">
                            {{-- Cambiado: nombre -> name y cantidad -> quantity --}}
                            <p class="text-[13px] font-semibold text-gray-800 dark:text-gray-100 truncate">{{ $top->name }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex-1 bg-gray-100 dark:bg-gray-800 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r {{ $top->colorFondo }}" style="width: {{ $top->percentage }}%"></div>
                                </div>
                                <span class="text-[11px] font-bold text-gray-500 shrink-0">{{ $top->quantity }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-sm text-gray-400">No hay ventas hoy.</div>
                @endforelse
            </div>
        </div>

        {{-- Flujo de Caja --}}
        <div class="animate-in delay-6 bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden mt-4">
            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Flujo de Caja</h3>
                <p class="text-xl font-black text-gray-900 dark:text-white">S/. {{ number_format($totalDay, 2) }}</p>
            </div>
            <div class="p-5 space-y-5">
                @php
                    // Cambiado variables: pagoEfectivo -> cashPayment, etc.
                    $pctCash  = $totalDay > 0 ? ($cashPayment / $totalDay) * 100 : 0;
                    $pctYape  = $totalDay > 0 ? ($yapePayment / $totalDay) * 100 : 0;
                    $pctCard  = $totalDay > 0 ? ($cardPayment / $totalDay) * 100 : 0;
                @endphp
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-bold text-gray-700">💵 Efectivo</span>
                        <span class="font-black">S/. {{ number_format($cashPayment, 2) }}</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $pctCash }}%"></div>
                    </div>
                </div>
                {{-- Barra Yape y Tarjeta con la misma lógica... --}}
            </div>
        </div>
    </div>
@endsection
