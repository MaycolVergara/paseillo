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
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>Libre
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-red-400"></span>Ocupada
                </span>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 p-6">
            {{-- $mesas_views -> $table_views --}}
            @foreach($table_views as $table)
                @php
                    // 1. Colores por defecto (Mesa Disponible)
                    $bgColor = 'bg-emerald-500';
                    $shadow = 'shadow-emerald-500/30';
                    $icon = '🍽️';

                    // 2. Lógica de estado y roles
                    // estado -> status
                    if ($table->status == 'ocupada') {

                        // usuarioAsignado -> assignedUser | rol -> role_id
                        if ($table->assignedUser && $table->assignedUser->role_id == 1) {
                            $bgColor = 'bg-purple-600';
                            $shadow = 'shadow-purple-500/40';
                            $icon = '👑';
                        }
                        // Si el que atiende es Mozo (rol 2)
                        else {
                            $bgColor = 'bg-blue-500';
                            $shadow = 'shadow-blue-500/40';
                            $icon = '🧑‍🍳';
                        }
                    }
                @endphp

                {{-- LA TARJETA DE LA MESA --}}
                {{-- detallePedidoMesasCliente -> tableOrderDetails --}}
                <a href="{{ url('/dashboard/tableOrderDetails/'.$table->id) }}"
                   class="relative block p-6 rounded-3xl text-white transition-all hover:scale-105 hover:shadow-xl {{ $bgColor }} {{ $shadow }}">

                    <div class="flex justify-between items-start">
                        {{-- numero_mesa -> table_number --}}
                        <h3 class="text-2xl font-black tracking-tight">Mesa {{ $table->table_number }}</h3>
                        <span class="text-2xl">{{ $icon }}</span>
                    </div>

                    <p class="text-sm font-bold opacity-90 mt-1 uppercase tracking-wider">
                        {{ $table->status }}
                    </p>

                    {{-- ETIQUETA DE QUIÉN ATIENDE --}}
                    @if($table->status == 'ocupada' && $table->assignedUser)
                        <div
                            class="mt-4 inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-white/20">
                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            <span class="text-[11px] font-bold">
                                {{-- nombre -> name --}}
                                Atiende: {{ $table->assignedUser->name }}
                            </span>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </div>

@endsection
