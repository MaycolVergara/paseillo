@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- ══════════════════════════
             BANNER HEADER
        ══════════════════════════ --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-red-500 to-rose-700 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-red-500/20">
                        <i data-lucide="trash-2" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Productos Eliminados de Ventas</h2>
                        <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">
                            @if ($start_date && $end_date)
                                Reporte del <span class="text-red-500">{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}</span>
                                al <span class="text-red-500">{{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</span>
                            @else
                                Historial detallado
                            @endif
                        </p>
                    </div>
                </div>

                <form action="{{ url('/dashboard/listadoProductosEliminados') }}" method="GET" class="flex flex-wrap items-end gap-3">
                    <div class="flex flex-col gap-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Desde</label>
                        <input type="datetime-local" name="start_date" value="{{ $start_date }}" required
                            class="text-sm font-medium bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2 text-gray-700 dark:text-gray-200 outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Hasta</label>
                        <input type="datetime-local" name="end_date" value="{{ $end_date }}" required
                            class="text-sm font-medium bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2 text-gray-700 dark:text-gray-200 outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    </div>
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-white text-sm font-black rounded-xl shadow-lg shadow-red-500/25 hover:scale-[1.02] active:scale-95 transition-all">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Filtrar
                    </button>
                </form>
            </div>
        </div>

        @if ($start_date && $end_date)
            {{-- ══════════════════════════
                 TABLA DE PRODUCTOS ELIMINADOS
            ══════════════════════════ --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-[15px] text-gray-900 dark:text-gray-100">Detalle de Productos Eliminados</h3>
                    </div>
                    <span class="text-[11px] font-black text-red-600 bg-red-100/80 dark:bg-red-900/30 px-3 py-1 rounded-xl uppercase tracking-widest">
                        {{ $deletedDetails->count() }} registros
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <div class="min-w-[900px]">
                        @if ($deletedDetails->count() > 0)
                            <div class="grid grid-cols-12 px-6 py-2.5 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700 text-[10px] font-black uppercase tracking-widest text-gray-400">
                                <div class="col-span-2">Fecha y Hora Eliminación</div>
                                <div class="col-span-3">Producto</div>
                                <div class="col-span-2 text-center">Cant. Eliminada</div>
                                <div class="col-span-2 text-right">Subtotal</div>
                                <div class="col-span-3 text-right">Origen (Venta/Mesa)</div>
                            </div>

                            <div class="divide-y divide-gray-50 dark:divide-gray-800">
                                @foreach($deletedDetails as $detail)
                                    @php
                                        $esDelivery = $detail->sale && !is_null($detail->sale->table_delivery_id);
                                        $mesaNumero = $detail->sale ? str_pad($detail->sale->table_number ?? $detail->sale->table_delivery_id, 2, '0', STR_PAD_LEFT) : 'N/A';
                                    @endphp
                                    <div class="w-full grid grid-cols-12 items-center px-6 py-3.5 hover:bg-red-50/30 dark:hover:bg-gray-800/30 transition-colors">
                                        <div class="col-span-2">
                                            <p class="text-[12px] font-semibold text-gray-700 dark:text-gray-300">
                                                {{ \Carbon\Carbon::parse($detail->deleted_at)->format('d/m/Y') }}
                                            </p>
                                            <p class="text-[10px] text-red-400 font-bold">
                                                {{ \Carbon\Carbon::parse($detail->deleted_at)->format('H:i:s') }}
                                            </p>
                                        </div>

                                        <div class="col-span-3">
                                            <span class="text-[12px] font-bold text-gray-800 dark:text-gray-200">
                                                {{ $detail->product ? $detail->product->name : '— Producto Desconocido —' }}
                                            </span>
                                            @if($detail->customization)
                                                <p class="text-[10px] text-gray-400 italic">Nota: {{ $detail->customization }}</p>
                                            @endif
                                        </div>

                                        <div class="col-span-2 text-center">
                                            <span class="text-[11px] font-black bg-red-100 dark:bg-red-900/30 text-red-600 px-2 py-0.5 rounded-lg">
                                                x{{ $detail->quantity }}
                                            </span>
                                        </div>

                                        <div class="col-span-2 text-right">
                                            <span class="text-[13px] font-black text-gray-900 dark:text-white">
                                                S/ {{ number_format($detail->subtotal, 2) }}
                                            </span>
                                        </div>

                                        <div class="col-span-3 text-right">
                                            @if($detail->sale)
                                                <span class="text-[12px] font-bold text-gray-600 dark:text-gray-300">
                                                    {{ $esDelivery ? 'Delivery' : 'Salón' }} | Mesa {{ $mesaNumero }}
                                                </span>
                                                <p class="text-[10px] text-gray-400">Venta #{{ $detail->sale->id }}</p>
                                            @else
                                                <span class="text-[12px] font-bold text-gray-400">Venta Eliminada</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-16 text-center">
                                <span class="text-sm font-black text-red-300 opacity-40 mb-4">SIN ELIMINACIONES</span>
                                <p class="text-sm font-bold text-gray-500">No se encontraron productos eliminados en este rango</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
