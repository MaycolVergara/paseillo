@extends('layouts.app')

@section('content')
    {{-- Contenedor principal sin límites laterales para que ocupe todo --}}
    <div
        class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 mb-6 mt-4 mx-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="truck" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Estado del Delivery
                    </h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Control de repartos en
                        tiempo real</p>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">

        @if (isset($table_view) && count($table_config) > 0)
            {{-- Quitamos el grid-cols-3 de afuera y dejamos que este div sea el único --}}
            <div
                class="w-full bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 p-8 min-h-[500px]">

                <div class="flex justify-between items-center border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-400">Vista del Salón</h3>
                    <div class="flex gap-3">
                        <div
                            class="flex items-center gap-4 text-[11px] font-bold bg-gray-50 dark:bg-gray-800/50 px-3 py-1.5 rounded-lg border border-gray-100 dark:border-gray-700">
                            <span class="flex items-center gap-1.5 text-rose-500 dark:text-rose-400">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-[0_0_8px_#f43f5e]">
                                </span>
                                "{{ $table_view->where('status', 'disponible')->count() }}" Libre
                            </span>
                            <span class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_8px_#34d399]">
                                </span>
                                "{{ $table_view->where('status', 'ocupado')->count() }}" Ocupada
                            </span>
                        </div>

                    </div>
                </div>

                {{-- GRID RESPONSIVO: De 2 columnas en móvil progresando hasta 5 en desktop --}}
                {{-- GRID RESPONSIVO: Mas estrecho para que quepan mas unidades --}}
                <div id="contenedor-mesas"
                    class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-8 gap-3 sm:gap-4 lg:gap-6">
                    @foreach ($table_config as $table)
                        <a href="{{ url('/dashboard/tableOrderDetailsDelyvery/' . $table->id) }}"
                            class="aspect-[0.85/1] flex flex-col items-center justify-center gap-1.5 p-3 rounded-2xl border-4
                               {{ $table->status == 'disponible'
                                   ? 'border-red-400 bg-red-100 text-red-700'
                                   : 'border-red-800 bg-red-900 text-white' }} hover:scale-105 transition-all shadow-lg">

                            <span
                                class="text-2xl sm:text-3xl lg:text-5xl font-black tracking-tighter leading-none">{{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-[9px] font-black uppercase tracking-wider">{{ $table->status }}</span>
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
