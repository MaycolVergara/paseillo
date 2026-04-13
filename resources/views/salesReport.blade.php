@extends('layouts.app')

@section('content')
<div class="space-y-6 animate-in fade-in duration-500">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                <i data-lucide="bar-chart-3" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">{{ $title }}</h2>
                <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">{{ $subtitle }}</p>
            </div>
        </div>
        
        <div class="flex items-center bg-gray-50 dark:bg-gray-800 p-1.5 rounded-2xl border border-gray-100 dark:border-gray-700">
            <div class="px-4 py-1 text-center border-r border-gray-200 dark:border-gray-700">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Pedidos</p>
                <p class="text-base font-black text-gray-900 dark:text-white">{{ $orderCount }}</p>
            </div>
            <div class="px-4 py-1 text-center">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Total Recaudado</p>
                <p class="text-base font-black text-emerald-500 tracking-tight">S/ {{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
    </div>

    {{-- Listado de Ventas --}}
    <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50">
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">ID / Fecha</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Atención</th>
                        <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Método</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Total</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @forelse($sales as $sale)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-xs font-black text-gray-800 dark:text-white">#{{ $sale->id }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y H:i') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if($sale->table_number)
                                    <span class="px-2 py-0.5 bg-amber-100 text-amber-600 text-[9px] font-black rounded-md uppercase tracking-widest">Mesa {{ $sale->table_number }}</span>
                                @else
                                    <span class="px-2 py-0.5 bg-rose-100 text-rose-600 text-[9px] font-black rounded-md uppercase tracking-widest">Delivery</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-[9px] font-black rounded-md uppercase tracking-widest">
                                {{ $sale->payment_method ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-black text-gray-900 dark:text-white italic">
                            S/ {{ number_format($sale->total, 2) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ url('/dashboard/issueReceipt/'.$sale->id) }}" target="_blank" class="inline-flex items-center justify-center p-2 bg-gray-50 dark:bg-gray-800 hover:bg-orange-50 dark:hover:bg-orange-900/30 text-gray-400 hover:text-orange-500 rounded-xl transition-all">
                                <i data-lucide="printer" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center text-3xl opacity-30">📊</div>
                                <p class="text-sm font-bold text-gray-400">No se encontraron ventas en este periodo.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
