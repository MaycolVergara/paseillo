@extends('layouts.app')

@section('content')
    {{-- Encabezado Principal --}}
    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="layout-grid" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Panel de Mesas</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Configuración del Salón</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all active:scale-95">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- COLUMNA IZQUIERDA: Vista del Salón --}}
        <div
            class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 p-6 min-h-[400px]">
            <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-6">
                <h3 class="text-xs font-black uppercase tracking-widest text-gray-400">Vista del Salón</h3>
                {{-- Cambiado: $totalMesas -> $table_view->count() --}}
                <span id="texto-estado" class="text-xs font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-lg">Mesas actuales:{{ $table_view->where('status', 'disponible')->count() }}</span>
            </div>
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-md rounded-r-xl animate-bounce">
                    <div class="flex items-center">
                        <span class="text-sm font-black mr-2">ALERTA</span>
                        <p class="font-black uppercase text-xs">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
            <div id="contenedor-mesas" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-4">
                @if(isset($table_config) && count($table_config) > 0)

                    @foreach($table_config as $table)
                        {{-- He aumentado el padding (p-10) y el redondeado para que el botón sea masivo --}}
                        <button
                           class="aspect-square flex flex-col items-center justify-center gap-2 p-4 sm:p-6 md:p-10 rounded-2xl sm:rounded-[2rem] md:rounded-[3rem] border-2 md:border-4
                           {{ $table->status == 'disponible' ? 'border-emerald-100 bg-emerald-50 text-emerald-600' :
                                'border-red-100 bg-red-50 text-red-600' }} hover:scale-105 transition-all shadow-xl">

                            {{-- Número GIGANTE (text-6xl) --}}
                            <span class="text-3xl sm:text-4xl md:text-6xl font-black tracking-tighter">{{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}</span>

                            {{-- Texto del estado más legible --}}
                            <span class="text-xs font-black uppercase tracking-widest">{{ $table->status }}</span>
                        </button>
                    @endforeach
                @else
                    <div class="col-span-full flex flex-col items-center justify-center py-10 text-gray-400">
                        <p class="text-sm font-bold">Aún no hay mesas generadas</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- COLUMNA DERECHA: Formulario de Registro --}}
        <div
            class="lg:col-span-1 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden sticky top-6">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                <h3 class="text-lg font-black text-gray-800 dark:text-white">Ajustar Salón</h3>
                <p class="text-xs text-gray-500 mt-1">Configura la cantidad total de mesas.</p>
            </div>

            {{-- Ruta actualizada: /dashboard/tableRegistration/insert --}}
            <form action="{{ url('/dashboard/tableRegistration/insert') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-6">
                    <label
                        class="block text-[11px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2 text-center">
                        ¿Cuántas mesas hay en total?
                    </label>
                    {{-- Cambiado: name="cantidad" -> name="quantity" --}}
                    <input type="number" name="quantity" required min="1" max="100" placeholder="Ej. 10"
                           class="w-full px-4 py-6 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl text-4xl outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all font-black text-center text-gray-800 dark:text-white shadow-inner">
                </div>

                <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-orange-500 to-red-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-orange-500/25 hover:scale-[1.02] active:scale-95 transition-all flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Generar Mesas
                </button>
            </form>
        </div>
    </div>
@endsection
