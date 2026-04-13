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
        
        <div class="flex items-center gap-2">
            <span class="px-4 py-1.5 bg-orange-50 dark:bg-orange-950/20 text-orange-600 dark:text-orange-400 text-[10px] font-black rounded-xl uppercase tracking-widest border border-orange-100 dark:border-orange-900/40">
                Reporte de Análisis
            </span>
        </div>
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
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Ticket Promedio</p>
            <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">S/ {{ number_format($avgTicket, 2) }}</h3>
            <div class="mt-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Gasto prom. por cliente</p>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         3. SECCION DE GRAFICO Y TOP PRODUCTO
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        {{-- Gráfico de Tendencia --}}
        <div class="xl:col-span-2 bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
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
                <canvas id="reportChart"></canvas>
            </div>
        </div>

        {{-- Top Performance & Insights --}}
        <div class="space-y-6">
            {{-- Producto Estrella --}}
            <div class="bg-gray-900 dark:bg-black rounded-3xl p-6 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <i data-lucide="star" class="w-24 h-24 text-yellow-400"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-yellow-500 uppercase tracking-widest mb-1">Producto Estrella</p>
                    <h4 class="text-2xl font-black text-white italic mb-4 uppercase tracking-tight">Top Desempeño</h4>
                    
                    @if($topProduct)
                    <div class="flex items-center gap-4 bg-white/5 p-4 rounded-2xl border border-white/10">
                        <div class="text-3xl">🔥</div>
                        <div>
                            <p class="text-base font-black text-white leading-none uppercase">{{ $topProduct->name }}</p>
                            <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-widest">{{ $topProduct->total_quantity }} unidades vendidas</p>
                        </div>
                    </div>
                    @else
                    <p class="text-sm font-bold text-gray-500 italic">No hay datos suficientes</p>
                    @endif
                </div>
            </div>

            {{-- Salud del Negocio --}}
            <div class="bg-gradient-to-br from-red-600 to-rose-700 rounded-3xl p-6 text-white shadow-lg shadow-red-500/20">
                <h4 class="text-sm font-black uppercase tracking-widest mb-4 flex items-center gap-2">
                    <i data-lucide="activity" class="w-4 h-4"></i> Estado del Periodo
                </h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center border-b border-white/10 pb-3">
                        <p class="text-[10px] font-bold uppercase tracking-widest opacity-80">Cumplimiento</p>
                        <p class="text-sm font-black italic">Operativo 100%</p>
                    </div>
                    <div class="flex justify-between items-center border-b border-white/10 pb-3">
                        <p class="text-[10px] font-bold uppercase tracking-widest opacity-80">Eficiencia</p>
                        <p class="text-sm font-black italic">Alto Volumen</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-[10px] font-bold uppercase tracking-widest opacity-80">Proyección</p>
                        <p class="text-sm font-black italic">Estable</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts para Gráficos --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('reportChart').getContext('2d');
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(249, 115, 22, 0.4)');
        gradient.addColorStop(1, 'rgba(249, 115, 22, 0.0)');

        const labels = {!! json_encode($chartLabels) !!};
        const data = {!! json_encode($chartData) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas',
                    data: data,
                    borderColor: '#f97316',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#ea580c',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        padding: 12,
                        callbacks: {
                            label: function(context) { return ' S/ ' + context.parsed.y.toFixed(2); }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#9ca3af', font: { size: 10, weight: '600' } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(156, 163, 175, 0.1)', borderDash: [5, 5] },
                        ticks: { color: '#9ca3af', font: { size: 10 } }
                    }
                }
            }
        });
    });
</script>
@endsection
