@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- ══════════════════════════
             BANNER HEADER
        ══════════════════════════ --}}
        <div
            class="relative bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/50 dark:border-gray-800 overflow-hidden">
            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-orange-400 via-red-500 to-rose-600"></div>
            <div class="px-7 py-5 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-100 to-red-50 dark:from-gray-800 dark:to-gray-800 border border-orange-200/50 dark:border-gray-700 flex items-center justify-center shadow-inner">
                        <span class="text-sm font-black text-orange-500">RV</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight">Registro de
                            Ventas</h2>
                        <p class="text-xs font-semibold text-gray-400 mt-0.5">
                            @if ($start_date && $end_date)
                                Reporte del
                                <span
                                    class="text-orange-500">{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y H:i') }}</span>
                                al
                                <span
                                    class="text-orange-500">{{ \Carbon\Carbon::parse($end_date)->format('d/m/Y H:i') }}</span>
                            @else
                                Selecciona un rango de fechas para generar el reporte
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Filtro de fechas inline --}}
                <form action="{{ url('/dashboard/saleDetails') }}" method="GET" class="flex flex-wrap items-end gap-3">
                    <div class="flex flex-col gap-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Desde</label>
                        <input type="datetime-local" name="start_date" value="{{ $start_date }}" required
                            class="text-sm font-medium bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2 text-gray-700 dark:text-gray-200 outline-none focus:border-orange-400 transition-colors">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Hasta</label>
                        <input type="datetime-local" name="end_date" value="{{ $end_date }}" required
                            class="text-sm font-medium bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-2 text-gray-700 dark:text-gray-200 outline-none focus:border-orange-400 transition-colors">
                    </div>
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                        </svg>
                        Generar
                    </button>
                </form>
            </div>
        </div>

        {{-- ══════════════════════════
             TARJETAS RESUMEN (siempre visibles)
        ══════════════════════════ --}}

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Total Recaudado --}}
            <div
                class="col-span-2 lg:col-span-1 relative bg-gradient-to-br from-orange-500 via-red-500 to-rose-600 rounded-3xl p-5 shadow-lg shadow-orange-500/20 overflow-hidden">
                <div class="absolute -right-6 -top-6 w-28 h-28 bg-white/15 blur-2xl rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-black uppercase text-white/90 tracking-widest">Total
                            Recaudado</p>
                    </div>
                    <p class="text-3xl font-black text-white tracking-tighter">
                        <span class="text-lg font-bold opacity-80 mr-1">S/</span>{{ number_format($totalDay, 2) }}
                    </p>
                </div>
            </div>

            {{-- Nº Ventas --}}
            <div class="bg-white dark:bg-gray-900 rounded-3xl p-5 shadow-sm border border-gray-100 dark:border-gray-800">
                <div
                    class="w-9 h-9 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center mb-3 text-blue-500">
                    <img src="{{ asset('icon/venta.png') }}" alt="TotalVenta" class="w-6 h-6 object-contain">

                </div>
                <p class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Nº Ventas</p>
                <p class="text-2xl font-black text-gray-900 dark:text-white mt-1">{{ $totalVentas }}</p>
                <p class="text-[10px] text-gray-400 mt-1">
                    <span class="text-emerald-500 font-bold">{{ $ventasSalon }} salón</span>
                    &nbsp;·&nbsp;
                    <span class="text-red-500 font-bold">{{ $ventasDelivery }} delivery</span>
                </p>
            </div>
            @php $pctCash = ($totalDay ?? 0) > 0 ? ($cashPayment / $totalDay) * 100 : 0; @endphp

            {{-- EFECTIVO --}}
            <div
                class="bg-emerald-50/60 dark:bg-emerald-900/10 rounded-2xl p-3 border border-emerald-100 dark:border-emerald-800/30 flex flex-col gap-1.5">
                <div class="flex items-center justify-between">
                    <div
                        class="w-9 h-9 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-blue-500">
                        <img src="{{ asset('icon/dinero.png') }}" alt="TotalVenta" class="w-6 h-6 object-contain">
                    </div>
                    <span class="text-[40px] font-black text-emerald-600">{{ number_format($pctCash, 0) }}%</span>
                </div>
                <p class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Efectivo</p>
                <p class="text-2xl font-black text-gray-900 dark:text-white mt-1">
                    S/ {{ number_format($cashPayment ?? 0, 2) }}</p>
                <div class="w-full bg-gray-200/60 dark:bg-gray-700 rounded-full h-1 overflow-hidden">
                    <div class="h-full bg-emerald-400 rounded-full" style="width: {{ $pctCash }}%"></div>
                </div>
            </div>


            {{-- YAPE --}}
            @php
                $digitalTotal = $yapePayment ?? 0;
                $pctDigital = ($totalDay ?? 0) > 0 ? ($digitalTotal / $totalDay) * 100 : 0;
            @endphp
            <div
                class="bg-purple-50/60 dark:bg-purple-900/10 rounded-2xl p-3 border border-purple-100 dark:border-purple-800/30 flex flex-col gap-1.5">
                <div class="flex items-center justify-between">
                    <div
                        class="w-9 h-9 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-blue-500">
                        <img src="{{ asset('icon/yape.png') }}" alt="TotalVenta" class="w-6 h-6 object-contain">
                    </div>
                    <span class="text-[40px] font-black text-purple-600">{{ number_format($pctDigital, 0) }}%</span>
                </div>
                <p class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Yape</p>
                <p class="text-2xl font-black text-gray-900 dark:text-white mt-1">
                    S/ {{ number_format($digitalTotal, 2) }}</p>
                <div class="w-full bg-gray-200/60 dark:bg-gray-700 rounded-full h-1 overflow-hidden">
                    <div class="h-full bg-purple-400 rounded-full" style="width: {{ $pctDigital }}%"></div>
                </div>
            </div>

            {{-- TARJETA --}}
            @php $pctCard = ($totalDay ?? 0) > 0 ? ($cardPayment / $totalDay) * 100 : 0; @endphp

            <div
                class="bg-blue-50/60 dark:bg-blue-900/10 rounded-2xl p-3 border border-blue-100 dark:border-blue-800/30 flex flex-col gap-1.5">
                <div class="flex items-center justify-between">
                    <div
                        class="w-9 h-9 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-blue-500">
                        <img src="{{ asset('icon/tarjeta.png') }}" alt="TotalVenta" class="w-6 h-6 object-contain">
                    </div>
                    <span class="text-[40px] font-black text-blue-600">{{ number_format($pctCard, 0) }}%</span>
                </div>
                <p class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Tarjeta</p>
                <p class="text-2xl font-black text-gray-900 dark:text-white mt-1">
                    S/ {{ number_format($cardPayment ?? 0, 2) }}</p>
                <div class="w-full bg-gray-200/60 dark:bg-gray-700 rounded-full h-1 overflow-hidden">
                    <div class="h-full bg-blue-400 rounded-full" style="width: {{ $pctCard }}%"></div>
                </div>
            </div>
        </div>

        @if ($start_date && $end_date)
            {{-- ══════════════════════════
                 TABLA DE VENTAS
            ══════════════════════════ --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100/80 dark:border-gray-800 overflow-hidden">

                {{-- Header tabla --}}
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-[15px] text-gray-900 dark:text-gray-100">Detalle de Ventas</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Haz clic en una venta para ver sus productos</p>
                    </div>
                    <span
                        class="text-[11px] font-black text-orange-600 bg-orange-100/80 dark:bg-orange-900/30 px-3 py-1 rounded-xl uppercase tracking-widest">
                        {{ $totalVentas }} registros
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <div class="min-w-[900px]">
                        {{-- Encabezado columnas --}}
                        @if ($sales->count() > 0)
                            <div
                                class="grid grid-cols-12 px-6 py-2.5 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700 text-[10px] font-black uppercase tracking-widest text-gray-400">
                                <div class="col-span-1">#</div>
                                <div class="col-span-2">Mesa</div>
                                <div class="col-span-3">Fecha y Hora</div>
                                <div class="col-span-2">Tipo</div>
                                <div class="col-span-2">Método Pago</div>
                                <div class="col-span-1 text-right">Total</div>
                                <div class="col-span-1 text-center">Ver</div>
                            </div>
                        @endif

                        <div class="divide-y divide-gray-50 dark:divide-gray-800">
                            @forelse($sales as $sale)
                                @php
                                    $esDelivery = !is_null($sale->table_delivery_id);
                                    $metodo = $sale->payment_method ?? 'Cash';
                                    $metodoBadge = match (strtolower($metodo)) {
                                        'yape' => [
                                            'label' => 'Yape',
                                            'color' =>
                                                'bg-teal-50 text-teal-600 border border-teal-200 dark:bg-teal-900/20 dark:border-teal-800',
                                        ],

                                        'card' => [
                                            'label' => 'Tarjeta',
                                            'color' =>
                                                'bg-blue-50 text-blue-600 border border-blue-200 dark:bg-blue-900/20 dark:border-blue-800',
                                        ],
                                        'cash' => [
                                            'label' => 'Efectivo',
                                            'color' =>
                                                'bg-emerald-50 text-emerald-600 border border-emerald-200 dark:bg-emerald-900/20 dark:border-emerald-800',
                                        ],
                                        default => [
                                            'label' => $metodo,
                                            'color' => 'bg-gray-100 text-gray-500 border border-gray-200',
                                        ],
                                    };
                                @endphp

                                <div class="hover:bg-orange-50/30 dark:hover:bg-gray-800/30 transition-colors">

                                    {{-- Fila principal clickeable --}}
                                    <button type="button" onclick="toggleDetalle({{ $sale->id }})"
                                        class="w-full grid grid-cols-12 items-center px-6 py-3.5 text-left">

                                        <div class="col-span-1">
                                            <span class="text-[11px] font-black text-gray-400">#{{ $sale->id }}</span>
                                        </div>

                                        <div class="col-span-2">
                                            <span class="text-[12px] font-bold text-gray-700 dark:text-gray-200">
                                                {{ $esDelivery ? 'DLV' : 'SAL' }}
                                                Mesa {{ str_pad($sale->table_number, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </div>

                                        <div class="col-span-3">
                                            <p class="text-[12px] font-semibold text-gray-700 dark:text-gray-300">
                                                {{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}
                                            </p>
                                            <p class="text-[10px] text-gray-400">
                                                {{ \Carbon\Carbon::parse($sale->date)->format('H:i:s') }}
                                            </p>
                                        </div>

                                        <div class="col-span-2">
                                            <span
                                                class="text-[10px] font-black px-2.5 py-1 rounded-lg
                                        {{ $esDelivery
                                            ? 'bg-red-50 text-red-600 border border-red-200 dark:bg-red-900/20 dark:border-red-800'
                                            : 'bg-emerald-50 text-emerald-600 border border-emerald-200 dark:bg-emerald-900/20 dark:border-emerald-800' }}">
                                                {{ $esDelivery ? 'Delivery' : 'Salón' }}
                                            </span>
                                        </div>

                                        <div class="col-span-2">
                                            <span
                                                class="text-[10px] font-black px-2.5 py-1 rounded-lg {{ $metodoBadge['color'] }}">
                                                {{ $metodoBadge['label'] }}
                                            </span>
                                        </div>

                                        <div class="col-span-1 text-right">
                                            <span class="text-[13px] font-black text-gray-900 dark:text-white">
                                                S/ {{ number_format($sale->total, 2) }}
                                            </span>
                                        </div>

                                        <div class="col-span-1 flex justify-center">
                                            <svg id="icon-{{ $sale->id }}"
                                                class="w-4 h-4 text-gray-400 transition-transform duration-300" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </button>

                                    {{-- Detalle expandible --}}
                                    <div id="detalle-{{ $sale->id }}" class="hidden px-6 pb-4">
                                        <div
                                            class="bg-gray-50 dark:bg-gray-800/40 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
                                            <div
                                                class="px-4 py-2.5 bg-gray-100/70 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                                <p class="text-[11px] font-black uppercase tracking-widest text-gray-500">
                                                    Productos
                                                    del pedido</p>
                                            </div>
                                            <div class="overflow-x-auto">
                                                <table class="w-full text-left min-w-[600px]">
                                                    <thead
                                                        class="text-[10px] uppercase tracking-wider text-gray-400 bg-white/50 dark:bg-gray-800/30">
                                                        <tr>
                                                            <th class="px-4 py-2.5 font-black">Producto</th>
                                                            <th class="px-4 py-2.5 font-black text-center">Cant.</th>
                                                            <th class="px-4 py-2.5 font-black text-right">P. Unit.</th>
                                                            <th class="px-4 py-2.5 font-black text-right">Subtotal</th>
                                                            <th class="px-4 py-2.5 font-black">Personalización</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                                        @php $details = \App\Models\SaleDetailModel::where('sale_id', $sale->id)->get(); @endphp
                                                        @foreach ($details as $detail)
                                                            @php $product = \App\Models\ProductModel::find($detail->product_id); @endphp
                                                            <tr class="hover:bg-white dark:hover:bg-gray-800/50 transition-colors">
                                                                <td
                                                                    class="px-4 py-2.5 text-[12px] font-bold text-gray-800 dark:text-gray-200">
                                                                    {{ $product ? $product->name : '— Producto eliminado —' }}
                                                                </td>
                                                                <td class="px-4 py-2.5 text-center">
                                                                    <span
                                                                        class="text-[11px] font-black bg-orange-100 dark:bg-orange-900/30 text-orange-600 px-2 py-0.5 rounded-lg">
                                                                        x{{ $detail->quantity }}
                                                                    </span>
                                                                </td>
                                                                <td
                                                                    class="px-4 py-2.5 text-right text-[12px] text-gray-500 dark:text-gray-400 font-semibold">
                                                                    S/ {{ number_format($detail->unit_price, 2) }}
                                                                </td>
                                                                <td
                                                                    class="px-4 py-2.5 text-right text-[12px] font-black text-gray-900 dark:text-white">
                                                                    S/ {{ number_format($detail->subtotal, 2) }}
                                                                </td>
                                                                <td class="px-4 py-2.5 text-[11px] text-gray-400 italic">
                                                                    {{ $detail->customization ?? '—' }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="bg-orange-50/60 dark:bg-orange-900/10">
                                                            <td colspan="3"
                                                                class="px-4 py-2.5 text-[11px] font-black uppercase tracking-widest text-gray-400 text-right">
                                                                Total
                                                            </td>
                                                            <td class="px-4 py-2.5 text-right text-[14px] font-black text-orange-600">
                                                                S/ {{ number_format($sale->total, 2) }}
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="flex flex-col items-center justify-center py-16 text-center">
                                    <span class="text-sm font-black text-gray-300 opacity-40 mb-4">SIN RESULTADOS</span>
                                    <p class="text-sm font-bold text-gray-500">No se encontraron ventas en este rango</p>
                                    <p class="text-xs text-gray-400 mt-1">Intenta con un rango de fechas diferente</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Footer total --}}
                @if ($sales->count() > 0)
                    <div
                        class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/30 flex items-center justify-between">
                        <p class="text-xs font-black uppercase tracking-widest text-gray-400">Total del Reporte</p>
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-sm font-bold text-gray-400">S/</span>
                            <span
                                class="text-2xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($totalDay, 2) }}</span>
                        </div>
                    </div>
                @endif

            </div>
        @endif

    </div>

@endsection
