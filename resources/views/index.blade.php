@extends('layouts.app')

@section('content')

    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-3">

        {{-- Contenedor FLEX para poner el texto a la izquierda y el botón a la derecha --}}
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">

            {{-- Lado Izquierdo: Textos --}}
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    @if(Auth::user()->rol==1)
                        ¡Buen día, Admin {{ Auth::user()->nombre}}! 👋
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
                {{-- Cambié el enlace a '/' y agregué target="_blank" para que abra en otra pestaña --}}
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
        <div
            class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-red-500 to-orange-400 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Ventas
                        Hoy</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">
                        S/. {{ number_format($totalDia, 2) }}
                    </p>
                    <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 mt-2 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-3 h-3">
                            <path fill-rule="evenodd"
                                  d="M8 14a.75.75 0 01-.75-.75V4.56L4.03 7.78a.75.75 0 01-1.06-1.06l4.5-4.5a.75.75 0 011.06 0l4.5 4.5a.75.75 0 01-1.06 1.06L8.75 4.56v8.69A.75.75 0 018 14z"
                                  clip-rule="evenodd"/>
                        </svg>
                        +14.2% vs ayer
                    </p>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-100 to-orange-100 dark:from-red-950/40 dark:to-orange-950/40 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    💰
                </div>
            </div>
        </div>

        {{-- Tarjeta: Pedidos Totales --}}
        <div
            class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-orange-400 to-amber-400 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                        Pedidos Mesas</p>

                    {{-- Aquí está la magia: cambiamos el 94 por la variable real --}}
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $pedidosHoy }}</p>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    🧾
                </div>
            </div>
        </div> {{-- Tarjeta: Pizzas --}}
        <div
            class="animate-in delay-3 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-rose-400 to-pink-500 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                        Pizzas</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $pizzasVendidas }}</p>
                    <p class="text-[10px] font-semibold text-gray-400 mt-2">Unidades hoy</p>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-rose-50 dark:bg-rose-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    🍕
                </div>
            </div>
        </div>

        {{-- Tarjeta: Hamburguesas --}}
        <div
            class="animate-in delay-4 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-amber-500 to-yellow-400 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                        Hamburguesas</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $hamburguesasVendidas }}</p>
                    <p class="text-[10px] font-semibold text-gray-400 mt-2">Unidades hoy</p>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    🍔
                </div>
            </div>
        </div>

        {{-- Tarjeta: Gaseosas / Bebidas --}}
        <div
            class="animate-in delay-5 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-blue-400 to-cyan-400 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                        Bebidas</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $gaseosasVendidas }}</p>
                    <p class="text-[10px] font-semibold text-gray-400 mt-2">Unidades hoy</p>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    🥤
                </div>
            </div>
        </div>

        {{-- Tarjeta: Krispy / Pollo --}}
        <div
            class="animate-in delay-6 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-orange-500 to-red-500 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                        Krispy</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $krispyVendidos }}</p>
                    <p class="text-[10px] font-semibold text-gray-400 mt-2">Unidades hoy</p>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    🍗
                </div>
            </div>
        </div>

        {{-- Tarjeta: Salchipapas --}}
        <div
            class="animate-in delay-7 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-card hover:shadow-card-hover transition-shadow duration-300 border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group">
            <div class="accent-bar w-12 bg-gradient-to-r from-yellow-400 to-amber-500 mb-4"></div>
            <div class="flex items-start justify-between gap-2">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                        Salchipapas</p>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1.5 tracking-tight">{{ $salchipapasVendidas }}</p>
                    <p class="text-[10px] font-semibold text-gray-400 mt-2">Unidades hoy</p>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-yellow-50 dark:bg-yellow-950/30 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                    🍟
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mb-4">
        <div
            class="xl:col-span-2 animate-in delay-5 bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden flex flex-col">

            {{-- Cabecera del panel de mesas --}}
            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800">
                <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Estado de Mesas</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Vista general del salón en tiempo real</p>
            </div>

            {{-- Cuadrícula de las mesas --}}
            <div class="p-5 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                @foreach($mesas as $mesa)
                    @php
                        // Validamos exactamente la palabra que viene de tu BD
                        $esOcupada = strtolower($mesa->estado) == 'ocupada';

                        // Asignamos los colores
                        $claseColor = $esOcupada
                            ? 'border-red-200 bg-red-50 text-red-600 dark:bg-red-950/20 dark:border-red-900 hover:border-red-400'
                            : 'border-emerald-200 bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:border-emerald-900 hover:border-emerald-400';

                        // Definimos qué texto verá el usuario
                        $textoPantalla = $esOcupada ? 'Ocupada' : 'Libre';
                    @endphp

                    <div
                        class="cursor-pointer rounded-xl p-3 text-center border-2 {{ $claseColor }} hover:scale-105 transition-all duration-200 shadow-sm">
                        <p class="font-extrabold text-xl">{{ $mesa->numero_mesa }}</p>
                        <p class="text-[9px] font-bold mt-1 uppercase tracking-wide">{{ $textoPantalla }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div
            class="animate-in delay-6 bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800">
                <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Más Vendidos</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Top productos de hoy</p>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-800">

                {{-- Recorremos nuestro Top 5 automático --}}
                @forelse($topProductos as $index => $top)
                    @php
                        // Lógica para darle color oro, plata o bronce al número de puesto
                        $colorNumero = 'text-gray-300 dark:text-gray-600'; // Color gris por defecto para el 4 y 5
                        if ($index == 0) $colorNumero = 'text-amber-400';      // 1ro Oro
                        elseif ($index == 1) $colorNumero = 'text-gray-400';   // 2do Plata
                        elseif ($index == 2) $colorNumero = 'text-orange-600'; // 3ro Bronce
                    @endphp

                    <div
                        class="flex items-center gap-3.5 px-5 py-3.5 hover:bg-orange-50/40 dark:hover:bg-orange-950/10 transition-colors duration-150">
                        {{-- Número de puesto --}}
                        <span
                            class="font-extrabold text-sm {{ $colorNumero }} w-5 text-center shrink-0">{{ $index + 1 }}</span>

                        {{-- Emoji --}}
                        <span class="text-2xl leading-none">{{ $top->emoji }}</span>

                        <div class="flex-1 min-w-0">
                            {{-- Nombre del Producto --}}
                            <p class="text-[13px] font-semibold text-gray-800 dark:text-gray-100 truncate">{{ $top->nombre }}</p>

                            {{-- Barra de Progreso --}}
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex-1 bg-gray-100 dark:bg-gray-800 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r {{ $top->colorFondo }} rounded-full"
                                         style="width: {{ $top->porcentaje }}%"></div>
                                </div>
                                <span class="text-[11px] font-bold text-gray-500 shrink-0">{{ $top->cantidad }}</span>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="px-5 py-8 text-center text-sm text-gray-400 font-medium">
                        Aún no hay productos vendidos el día de hoy.
                    </div>
                @endforelse

            </div>
        </div>
        <div
            class="animate-in delay-6 bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden mt-4">
            <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Flujo de Caja</h3>
                    <p class="text-[11px] text-gray-400 mt-0.5">Ingresos de hoy por método</p>
                </div>
                <div class="text-right">
                    <p class="text-xl font-black text-gray-900 dark:text-white">
                        S/. {{ number_format($totalDia, 2) }}</p>
                </div>
            </div>

            <div class="p-5 space-y-5">
                @php
                    // Evitamos dividir por cero si aún no hay ventas
                    $pctEfectivo = $totalDia > 0 ? ($pagoEfectivo / $totalDia) * 100 : 0;
                    $pctYape     = $totalDia > 0 ? ($pagoYape / $totalDia) * 100 : 0;
                    $pctTarjeta  = $totalDia > 0 ? ($pagoTarjeta / $totalDia) * 100 : 0;
                @endphp

                {{-- Barra Efectivo --}}
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-bold text-gray-700 dark:text-gray-300">💵 Efectivo</span>
                        <span class="font-black">S/. {{ number_format($pagoEfectivo, 2) }}</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $pctEfectivo }}%"></div>
                    </div>
                </div>

                {{-- Barra Yape --}}
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-bold text-gray-700 dark:text-gray-300">📱 Yape / Plin</span>
                        <span class="font-black">S/. {{ number_format($pagoYape, 2) }}</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $pctYape }}%"></div>
                    </div>
                </div>

                {{-- Barra Tarjeta --}}
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-bold text-gray-700 dark:text-gray-300">💳 Tarjeta (POS)</span>
                        <span class="font-black">S/. {{ number_format($pagoTarjeta, 2) }}</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $pctTarjeta }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
