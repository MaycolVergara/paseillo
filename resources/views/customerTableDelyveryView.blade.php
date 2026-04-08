@extends('layouts.app')

@section('content')
    {{-- Contenedor principal sin límites laterales para que ocupe todo --}}
    <div class="px-7 py-5 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
        <div>
            <h3 class="font-extrabold text-[16px] text-gray-900 dark:text-gray-100">Estado del Salón</h3>
            <p class="text-xs font-medium text-gray-400 mt-0.5">Control de mesas en tiempo real</p>
        </div>

    </div>
    <div class="w-full">

        @if(isset($table_view) && count($table_config) > 0)
            {{-- Quitamos el grid-cols-3 de afuera y dejamos que este div sea el único --}}
            <div
                class="w-full bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 p-8 min-h-[500px]">

                <div class="flex justify-between items-center border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-400">Vista del Salón</h3>
                    <div class="flex gap-3">
                        <div
                            class="flex items-center gap-4 text-[11px] font-bold bg-gray-50 dark:bg-gray-800/50 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                                <span
                                    class="flex items-center gap-1.5 text-rose-500 dark:text-rose-400">
                                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-[0_0_8px_#f43f5e]">
                                            </span>
                                    "{{ $table_view->where('status', 'disponible')->count() }}" Libre
                                </span>
                            <span
                                class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_8px_#34d399]">
                                    </span>
                                "{{ $table_view->where('status', 'ocupado')->count() }}" Ocupada
                                </span>
                        </div>

                    </div>
                </div>

                {{-- GRID DE 5 COLUMNAS: Aquí es donde forzamos las 5 mesas por fila y que sean GRANDES --}}
                <div id="contenedor-mesas" class="grid grid-cols-5 gap-8">

                    @foreach($table_config as $table)
                        {{-- He aumentado el padding (p-10) y el redondeado para que el botón sea masivo --}}
                        <a href="{{ url('/dashboard/tableOrderDetailsDelyvery/'.$table->id) }}"
                           class="aspect-square flex flex-col items-center justify-center gap-3 p-10 rounded-[3rem] border-4
                               {{ $table->status == 'disponible' ? 'border-red-400 bg-red-100 text-red-700' :
                                    'border-red-800 bg-red-900 text-white' }} hover:scale-105 transition-all shadow-xl">

                            {{-- Número GIGANTE (text-6xl) --}}
                            <span
                                class="text-6xl font-black tracking-tighter">{{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}</span>

                            {{-- Texto del estado más legible --}}
                            <span class="text-xs font-black uppercase tracking-widest">{{ $table->status }}</span>
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
