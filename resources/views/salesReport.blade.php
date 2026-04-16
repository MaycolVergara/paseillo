@extends('layouts.app')

@section('content')
<div class="space-y-6 animate-in fade-in duration-500">
    {{-- ══════════════════════════════════════════════
         1. HEADER DEL DASHBOARD
    ══════════════════════════════════════════════ --}}
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
        
        {{-- FILTRADO DINÁMICO --}}
        <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap items-center gap-3 bg-gray-50 dark:bg-gray-800/50 p-2 rounded-2xl border border-gray-100 dark:border-gray-700">
            
            @if(Str::contains($title, 'Anual'))
                <select name="year" class="bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-black uppercase tracking-widest focus:ring-2 focus:ring-orange-500/20 py-2 px-4 shadow-sm cursor-pointer dark:text-gray-200">
                    @for($y = 2024; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ ($year ?? date('Y')) == $y ? 'selected' : '' }}>Año {{ $y }}</option>
                    @endfor
                </select>
            @endif

            @if(Str::contains($title, 'Mensual'))
                <select name="month" class="bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-black uppercase tracking-widest focus:ring-2 focus:ring-orange-500/20 py-2 px-4 shadow-sm cursor-pointer dark:text-gray-200">
                    @php $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']; @endphp
                    @foreach($months as $index => $name)
                        <option value="{{ $index + 1 }}" {{ ($month ?? date('n')) == ($index + 1) ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                <select name="year" class="bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-black uppercase tracking-widest focus:ring-2 focus:ring-orange-500/20 py-2 px-4 shadow-sm cursor-pointer dark:text-gray-200">
                    @for($y = 2024; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ ($year ?? date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            @endif

            @if(Str::contains($title, 'Semanal'))
                <input type="date" name="date" value="{{ ($targetDate ?? now())->format('Y-m-d') }}" class="bg-white dark:bg-gray-900 border-none rounded-xl text-xs font-black uppercase tracking-widest focus:ring-2 focus:ring-orange-500/20 py-2 px-4 shadow-sm cursor-pointer dark:text-gray-200">
            @endif

            <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-600 text-white p-2.5 rounded-xl hover:scale-105 active:scale-95 transition-all shadow-md shadow-orange-500/20">
                <i data-lucide="filter" class="w-4 h-4"></i>
            </button>
        </form>
    </div>

    {{-- ══════════════════════════════════════════════
         2. TARJETAS KPI (METRICAS)
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Ingresos --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 opacity-[0.03] dark:opacity-[0.05] group-hover:scale-110 transition-transform duration-500">
                <i data-lucide="banknote" class="w-32 h-32"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Ingresos Totales</p>
            <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">S/ {{ number_format($totalRevenue, 2) }}</h3>
            <div class="mt-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Recaudación bruta</p>
            </div>
        </div>

        {{-- Pedidos --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 opacity-[0.03] dark:opacity-[0.05] group-hover:scale-110 transition-transform duration-500">
                <i data-lucide="shopping-bag" class="w-32 h-32"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pedidos</p>
            <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $orderCount }}</h3>
            <div class="mt-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Atenciones finalizadas</p>
            </div>
        </div>

        {{-- Ticket Promedio --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 opacity-[0.03] dark:opacity-[0.05] group-hover:scale-110 transition-transform duration-500">
                <i data-lucide="trending-up" class="w-32 h-32"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total de tikes</p>
            <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">S/ {{ number_format($avgTicket, 2) }}</h3>
            <div class="mt-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Valor total de registros</p>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         3. SECCION DE GRAFICO Y TOP PRODUCTO
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1">
        {{-- Gráfico de Tendencia --}}
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-black text-gray-900 dark:text-white text-base italic uppercase tracking-tight">Tendencia de Ventas</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Progreso de ingresos en el tiempo</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/20 flex items-center justify-center text-orange-500">
                    <i data-lucide="line-chart" class="w-5 h-5"></i>
                </div>
            </div>
            
            <div class="relative h-[350px] w-full mt-4">
                <canvas id="reportChart" 
                        data-labels="{{ json_encode($chartLabels) }}" 
                        data-values="{{ json_encode($chartData) }}">
                </canvas>
            </div>
        </div>

    </div>
</div>
@endsection
