@extends('layouts.app')

@section('content')
    {{-- Contenedor principal sin límites laterales para que ocupe todo --}}
    <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 mb-6 mt-4 mx-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="layout-grid" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Estado del Salón</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Control de mesas en tiempo real</p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">

        @if(isset($table_view) && count($table_config) > 0)
            {{-- Quitamos el grid-cols-3 de afuera y dejamos que este div sea el único --}}
            <div
                class="w-full bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 p-8 min-h-[500px]">

                {{-- Leyenda de colores --}}
                <div class="flex justify-between items-center border-b border-gray-100 dark:border-gray-800 pb-6 mb-8">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-400">Vista del Salón</h3>
                    <div class="flex gap-3">
                        <div
                            class="flex items-center gap-4 text-[11px] font-bold bg-gray-50 dark:bg-gray-800/50 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                                <span class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_8px_#34d399]"></span>
                                    {{ $table_view->where('status', 'disponible')->count() }} Libre
                                </span>
                            <span class="flex items-center gap-1.5 text-rose-500 dark:text-rose-400">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-[0_0_8px_#f43f5e]"></span>
                                Admin
                            </span>
                            <span class="flex items-center gap-1.5 text-blue-500 dark:text-blue-400">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-[0_0_8px_#3b82f6]"></span>
                                Mozo
                            </span>
                        </div>
                    </div>
                </div>

                {{-- GRID RESPONSIVO: Adaptable a móviles y tablets --}}
                <div id="contenedor-mesas" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6 lg:gap-8">

                    @foreach($table_config as $table)
                        @php
                            // Determinar el color según el estado y quién atiende
                            if ($table->status == 'disponible') {
                                // Mesa libre = verde
                                $cardClass = 'border-emerald-100 bg-emerald-50 text-emerald-600 dark:border-emerald-900 dark:bg-emerald-950/30 dark:text-emerald-400';
                                $labelText = 'Disponible';
                            } elseif ($table->servingUser && $table->servingUser->role_id == 2) {
                                // Mozo atendiendo = azul
                                $cardClass = 'border-blue-200 bg-blue-50 text-blue-600 dark:border-blue-900 dark:bg-blue-950/30 dark:text-blue-400';
                                $labelText = $table->servingUser->name;
                            } else {
                                // Admin atendiendo = rojo
                                $cardClass = 'border-red-100 bg-red-50 text-red-600 dark:border-red-900 dark:bg-red-950/30 dark:text-red-400';
                                $labelText = $table->servingUser ? $table->servingUser->name : 'Ocupado';
                            }
                        @endphp

                        <a href="{{ url('/dashboard/tableOrderDetails/'.$table->table_number) }}"
                           class="aspect-square flex flex-col items-center justify-center gap-2 sm:gap-3 p-4 sm:p-6 lg:p-10 rounded-2xl sm:rounded-3xl lg:rounded-[3.5rem] border-4 {{ $cardClass }} hover:scale-105 transition-all shadow-xl">

                            {{-- Número RESPONSIVO --}}
                            <span class="text-3xl sm:text-4xl lg:text-7xl font-black tracking-tighter leading-none">{{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}</span>

                            {{-- Nombre de quién atiende o estado --}}
                            <span class="text-xs font-black uppercase tracking-widest text-center leading-tight">{{ $labelText }}</span>
                        </a>
                    @endforeach
                    @else
                        <div class="col-span-5 flex flex-col items-center justify-center py-20 text-gray-400">
                            <p class="text-lg font-bold">Aún no hay mesas generadas</p>
                        </div>

                </div>
            </div>
        @endif
    </div>
@endsection
