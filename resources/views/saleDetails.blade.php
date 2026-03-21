@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-200 dark:border-gray-800 p-6">
            <h3 class="text-base font-medium text-gray-700 dark:text-gray-200 mb-6">Registro de Ventas</h3>

            <form action="{{ url('/dashboard/saleDetails') }}" method="GET" class="space-y-5">

                <div class="relative border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2.5 bg-white dark:bg-gray-900 focus-within:border-amber-500 transition-colors">
                    <label class="absolute -top-2.5 left-3 bg-white dark:bg-gray-900 px-1 text-[11px] text-gray-400 font-medium">
                        Inicio de Venta
                    </label>
                    <input type="datetime-local" name="start_date" value="{{ $start_date }}" required
                           class="w-full text-sm outline-none bg-transparent text-gray-700 dark:text-gray-200">
                </div>

                <div class="relative border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2.5 bg-white dark:bg-gray-900 focus-within:border-amber-500 transition-colors">
                    <label class="absolute -top-2.5 left-3 bg-white dark:bg-gray-900 px-1 text-[11px] text-gray-400 font-medium">
                        Terminar la Venta
                    </label>
                    <input type="datetime-local" name="end_date" value="{{ $end_date }}" required
                           class="w-full text-sm outline-none bg-transparent text-gray-700 dark:text-gray-200">
                </div>

                <div class="text-center pt-2">
                    <button type="submit" class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-md shadow-sm transition-all">
                        Generar Reporte
                    </button>
                </div>
            </form>
        </div>

        @if($start_date && $end_date)
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-200 dark:border-gray-800 p-6">
                <h3 class="text-base font-medium text-gray-700 dark:text-gray-200 mb-4">Ventas Diarias (Detalle)</h3>

                <div class="space-y-3">
                    @forelse($sales as $sale)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden bg-white dark:bg-gray-900">

                            <button type="button" onclick="toggleDetalle({{ $sale->id }})"
                                    class="w-full flex justify-between items-center px-4 py-3 bg-white hover:bg-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 transition-colors text-left border-b border-transparent">
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            Venta N°: {{ $sale->id }} | Mesa: {{ $sale->table_number }} | Fecha: {{ \Carbon\Carbon::parse($sale->date)->format('Y-m-d H:i:s') }} | Total: S/ {{ number_format($sale->total, 2) }}
                        </span>
                                <svg id="icon-{{ $sale->id }}" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div id="detalle-{{ $sale->id }}" class="hidden px-4 pb-4 pt-2 border-t border-gray-100 dark:border-gray-800">
                                <p class="text-[13px] text-gray-600 dark:text-gray-400 mb-3">Productos en este pedido:</p>

                                <div class="overflow-x-auto">
                                    <table class="w-full text-left">
                                        <thead class="bg-gray-50 dark:bg-gray-800/50 text-[11px] uppercase tracking-wider text-gray-500">
                                        <tr>
                                            <th class="px-4 py-2 font-medium">Producto</th>
                                            <th class="px-4 py-2 font-medium">Cantidad</th>
                                            <th class="px-4 py-2 font-medium">Precio Unitario</th>
                                            <th class="px-4 py-2 font-medium">Subtotal</th>
                                            <th class="px-4 py-2 font-medium">Personalizado</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-[13px] text-gray-600 dark:text-gray-300 divide-y divide-gray-50 dark:divide-gray-800">

                                        @php
                                            $details = \App\Models\SaleDetail::where('sale_id', $sale->id)->get();
                                        @endphp

                                        @foreach($details as $detail)
                                            @php
                                                $product = \App\Models\Product::find($detail->product_id);
                                            @endphp
                                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30">
                                                <td class="px-4 py-2">{{ $product ? $product->name : 'Producto Eliminado' }}</td>
                                                <td class="px-4 py-2">{{ $detail->quantity }}</td>
                                                <td class="px-4 py-2">S/ {{ number_format($detail->unit_price, 2) }}</td>
                                                <td class="px-4 py-2">S/ {{ number_format($detail->subtotal, 2) }}</td>
                                                <td class="px-4 py-2">{{ $detail->customization ?? '---' }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-400 text-sm">
                            No se encontraron ventas finalizadas en este rango de fechas.
                        </div>
                    @endforelse
                </div>

                @if($sales->count() > 0)
                    <div class="mt-6 text-right pr-2">
                        <span class="text-xl text-gray-700 dark:text-gray-300">Total del Reporte: </span>
                        <span class="text-xl text-gray-900 dark:text-white">S/ {{ number_format($totalDay, 2) }}</span>
                    </div>
                @endif

            </div>
        @endif

    </div>


@endsection
