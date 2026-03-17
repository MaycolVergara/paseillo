@extends('layouts.app')

@section('content')

    <div
        class="bg-white dark:bg-gray-900 rounded-2xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden animate-in delay-6">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 dark:border-gray-800">
            <div>
                <h3 class="font-bold text-[14px] text-gray-800 dark:text-gray-100">Estado de Mesas</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Vista general del salón</p>
            </div>
            <div class="flex items-center gap-4 text-[11px] font-semibold text-gray-400">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400">

                    </span>Libre</span>
                <span class="flex items-center gap-1.5"><span
                        class="w-2 h-2 rounded-full bg-red-400">
                    </span>Ocupada</span>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 p-6">
            @foreach($mesas_views as $mesa)
                @php
                    // 1. Colores por defecto (Mesa Disponible)
                    $colorFondo = 'bg-emerald-500';
                    $sombra = 'shadow-emerald-500/30';
                    $icono = '🍽️';

                    // 2. Si la mesa está ocupada, cambiamos colores según quién atiende
                    if ($mesa->estado == 'ocupada') {

                        // Si el que atiende es Administrador (rol 1) -> MORADO
                        if ($mesa->usuarioAsignado && $mesa->usuarioAsignado->rol == 1) {
                            $colorFondo = 'bg-purple-600';
                            $sombra = 'shadow-purple-500/40';
                            $icono = '👑';
                        }
                        // Si el que atiende es Mozo (rol 2) -> AZUL
                        else {
                            $colorFondo = 'bg-blue-500';
                            $sombra = 'shadow-blue-500/40';
                            $icono = '🧑‍🍳';
                        }
                    }
                @endphp

                {{-- LA TARJETA DE LA MESA --}}
                <a href="{{ url('/dashboard/detallePedidoMesasCliente/'.$mesa->id_mesa) }}"
                   class="relative block p-6 rounded-3xl text-white transition-all hover:scale-105 hover:shadow-xl {{ $colorFondo }} {{ $sombra }}">

                    <div class="flex justify-between items-start">
                        <h3 class="text-2xl font-black tracking-tight">Mesa {{ $mesa->numero_mesa }}</h3>
                        <span class="text-2xl">{{ $icono }}</span>
                    </div>

                    <p class="text-sm font-bold opacity-90 mt-1 uppercase tracking-wider">
                        {{ $mesa->estado }}
                    </p>

                    {{-- 🌟 ETIQUETA DE QUIÉN ATIENDE --}}
                    @if($mesa->estado == 'ocupada' && $mesa->usuarioAsignado)
                        <div
                            class="mt-4 inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-white/20">
                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            <span class="text-[11px] font-bold">
                Atiende: {{ $mesa->usuarioAsignado->nombre }}
            </span>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </div>

@endsection
