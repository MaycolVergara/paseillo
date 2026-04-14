@extends('layouts.app')

@section('content')
    {{-- Encabezado del Reporte --}}
    {{-- Header Standard --}}
    <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Reporte de Personal</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Gestión de planilla y pagos</p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                <a href="{{ url('/dashboard/staffRegistration') }}"
                   class="flex items-center gap-1.5 sm:gap-2 px-6 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:shadow-orange-500/40 shadow-lg transition-all active:scale-95">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    Nuevo
                </a>
                <a href="{{ url('/dashboard/staffAdvanceRegistration') }}"
                   class="flex items-center gap-1.5 sm:gap-2 px-6 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-gray-800 to-gray-900 hover:shadow-gray-500/40 shadow-lg transition-all active:scale-95">
                    <i data-lucide="banknote" class="w-4 h-4"></i>
                    Adelanto
                </a>
                <a href="{{ url('/dashboard/staffAbsenceRegistration') }}"
                   class="flex items-center gap-1.5 sm:gap-2 px-6 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-rose-500 to-red-600 hover:shadow-rose-500/40 shadow-lg transition-all active:scale-95">
                    <i data-lucide="user-minus" class="w-4 h-4"></i>
                    Inasistencia
                </a>
            </div>
        </div>
    </div>
    {{-- Tarjetas de Rumen Financiero --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        {{-- Total Nómina --}}
        <div
            class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100 dark:border-gray-800 relative overflow-hidden group">
            <div
                class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity">
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-1">Total Nómina (Mes)</p>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">S/
                        {{ number_format($totalNomina, 2) }}</h3>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 relative z-10">
                <span
                    class="px-2 py-0.5 rounded-lg text-[10px] font-black uppercase bg-red-100 text-red-600 dark:bg-red-900/30">{{ $totalEmpleados }}
                    Empleados</span>
            </div>
        </div>

        {{-- Adelantos Emitidos --}}
        @php
            $porcentajeAdelanto = $totalNomina > 0 ? ($totalAdelantos / $totalNomina) * 100 : 0;
        @endphp
        <div
            class="animate-in delay-3 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 relative overflow-hidden group">
            <div
                class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-red-500/5 opacity-0 group-hover:opacity-100 transition-opacity">
            </div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-1">Adelantos Emitidos</p>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">S/
                        {{ number_format($totalAdelantos, 2) }}</h3>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400">
                    <i data-lucide="dollar-sign" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="mt-4 w-full bg-gray-100 dark:bg-gray-800 rounded-full h-1.5 relative z-10">
                <div class="bg-gradient-to-r from-orange-500 to-red-600 h-1.5 rounded-full"
                    style="width: {{ $porcentajeAdelanto }}%"></div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 mt-2 relative z-10">{{ number_format($porcentajeAdelanto, 1) }}%
                de la nómina en adelantos</p>
        </div>

        {{-- Pendiente de Pago --}}
        <div
            class="animate-in delay-4 bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-800 dark:to-gray-950 rounded-2xl p-6 shadow-xl relative overflow-hidden border border-gray-700">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-500/20 blur-3xl rounded-full"></div>
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-emerald-400 mb-1">Saldo a Pagar (Neto)
                    </p>
                    <h3 class="text-3xl font-black text-white tracking-tight">S/ {{ number_format($saldoPagar, 2) }}</h3>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-emerald-400 backdrop-blur-sm">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between relative z-10">
                <span class="text-[11px] font-medium text-gray-300">Nómina - Adelantos</span>
                <span
                    class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-black uppercase bg-emerald-500/20 text-emerald-300 border border-emerald-500/20">Descontado</span>
            </div>
        </div>
    </div>

    {{-- Diagramas y Listas Laterales --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        {{-- Gráfico de Diagrama de Pagos --}}
        <div
            class="animate-in delay-5 lg:col-span-3 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 p-6 flex flex-col">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h3 class="text-base font-black text-gray-900 dark:text-white mb-1">Diagrama de Egresos</h3>
                    <p class="text-xs text-gray-400 font-medium">Distribución visual de adelantos vs pagos por área.</p>
                </div>
                <div class="flex gap-4">
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-md bg-emerald-500"></div><span
                            class="text-[10px] font-bold text-gray-500">Neto</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-md bg-orange-500"></div><span
                            class="text-[10px] font-bold text-gray-500">Adelantos</span>
                    </div>
                </div>
            </div>

            <div class="flex-1 space-y-6">
                @foreach ($areas as $areaName => $data)
                    @if ($data['nomina'] > 0)
                        @php
                            $percAdelanto = $data['nomina'] > 0 ? ($data['adelantos'] / $data['nomina']) * 100 : 0;
                            $percNeto = 100 - $percAdelanto;
                        @endphp
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-2">
                                <span class="text-gray-700 dark:text-gray-300">{{ $areaName }}</span>
                                <span class="text-gray-900 dark:text-white font-black">S/
                                    {{ number_format($data['nomina'], 2) }}</span>
                            </div>
                            <div class="w-full h-3 bg-gray-100 dark:bg-gray-800 rounded-full flex overflow-hidden">
                                <div class="bg-emerald-500 h-full relative group" style="width: {{ $percNeto }}%">
                                    <div
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                        S/ {{ number_format($data['nomina'] - $data['adelantos'], 2) }}</div>
                                </div>
                                <div class="bg-orange-500 h-full relative group" style="width: {{ $percAdelanto }}%">
                                    <div
                                        class="absolute -top-8 right-0 -translate-x-1/2 bg-gray-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                        S/ {{ number_format($data['adelantos'], 2) }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Lista de Adelantos Recientes --}}
        <div
            class="animate-in delay-6 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-base font-black text-gray-900 dark:text-white">Adelantos Activos</h3>
            </div>

            <div class="space-y-4">
                @forelse($adelantosRecientes as $adelanto)
                    @php
                        // Color aleatorio para el avatar
                        $colors = [
                            'bg-orange-100 text-orange-600',
                            'bg-blue-100 text-blue-600',
                            'bg-purple-100 text-purple-600',
                            'bg-emerald-100 text-emerald-600',
                        ];
                        $colorCLass = $colors[$loop->index % count($colors)];
                        $iniciales = mb_strtoupper(
                            mb_substr($adelanto->name, 0, 1) . mb_substr($adelanto->surname, 0, 1),
                        );
                    @endphp
                    <div
                        class="flex items-center gap-3 p-3 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-700 group">
                        <div
                            class="w-10 h-10 rounded-xl {{ $colorCLass }} dark:bg-opacity-20 font-black text-sm shrink-0 flex items-center justify-center">
                            {{ $iniciales }}</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $adelanto->name }}
                                {{ $adelanto->surname }}</p>
                            <p class="text-[10px] text-gray-400 font-medium">{{ $adelanto->position }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm font-black text-orange-500">- S/
                                {{ number_format($adelanto->advance_payment, 2) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">No hay adelantos registrados.</p>
                @endforelse

                {{-- Boton Nuevo Adelanto --}}

            </div>
        </div>

        {{-- Lista de Pagos Realizados Hoy --}}
        <div
            class="animate-in delay-6 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-base font-black text-gray-900 dark:text-white">Pagos Hoy</h3>
            </div>
            <div class="space-y-2">
                @forelse($ultimosPagos as $pago)
                    @php
                        $staffName = $pago->staff->name ?? 'N';
                        $staffSurname = $pago->staff->surname ?? 'A';
                        $iniciales = mb_strtoupper(
                            mb_substr($staffName, 0, 1) . mb_substr($staffSurname, 0, 1),
                        );
                    @endphp
                    <div
                        class="flex items-center gap-3 p-3 rounded-2xl bg-emerald-50/50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-800 flex-wrap">
                        <div
                            class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 dark:bg-opacity-20 font-black text-sm shrink-0 flex items-center justify-center">
                            {{ $iniciales }}</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-bold text-gray-900 dark:text-white truncate">
                                {{ $staffName }}
                                {{ $staffSurname }}</p>
                            <p class="text-[10px] text-gray-400 font-medium whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($pago->created_at)->diffForHumans() }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm font-black text-emerald-500">+ S/
                                {{ number_format($pago->net_paid, 2) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <p class="text-[11px] text-gray-400 font-medium">Aún no se registraron pagos hoy.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Lista de Pagos Pendientes HOY --}}
        <div
            class="animate-in delay-6 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-base font-black text-gray-900 dark:text-white">Faltan Pagar HOY</h3>
            </div>
            <div class="space-y-2">
                @forelse($pendientesPago as $pendiente)
                    @php
                        $inicialesP = mb_strtoupper(
                            mb_substr($pendiente->name, 0, 1) . mb_substr($pendiente->surname, 0, 1),
                        );
                        $netoP = $pendiente->salary - $pendiente->advance_payment - $pendiente->absence_discount;
                    @endphp
                    <div
                        class="flex items-center gap-3 p-3 rounded-2xl bg-amber-50/50 dark:bg-amber-900/10 border border-amber-100 dark:border-amber-800 flex-wrap">
                        <div
                            class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 dark:bg-opacity-20 font-black text-sm shrink-0 flex items-center justify-center">
                            {{ $inicialesP }}</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-bold text-gray-900 dark:text-white truncate">{{ $pendiente->name }}
                                {{ $pendiente->surname }}</p>
                            <p class="text-[10px] text-amber-500 font-medium whitespace-nowrap">Esperando pago</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm font-black text-amber-600">S/ {{ number_format($netoP, 2) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <p class="text-[11px] text-gray-400 font-medium">¡Al día con los pagos de hoy!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Tabla Resumen de Próximos Pagos --}}
    <div
        class="animate-in delay-7 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50 dark:bg-gray-800/20">
            <div>
                <h3 class="text-lg font-black text-gray-900 dark:text-white flex items-center gap-2">
                    <i data-lucide="calendar-days" class="w-5 h-5 text-blue-500"></i>
                    Cronograma de Pagos
                </h3>
                <p class="text-xs text-gray-500 mt-1">Detalle personal por trabajador para el periodo seleccionado.</p>
            </div>

            <div class="relative w-full sm:max-w-xs">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <i data-lucide="search" class="w-3.5 h-3.5"></i>
                </span>
                <input type="text" id="searchInput" placeholder="Buscar empleado..."
                    class="w-full pl-9 pr-4 py-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all outline-none dark:text-white">
            </div>
        </div>

        <div class="overflow-x-auto w-full scrollbar-thin scrollbar-thumb-gray-200 dark:scrollbar-thumb-gray-800">
            <div class="min-w-[1000px] lg:min-w-full inline-block align-middle">
            <table class="w-full text-left border-collapse table-auto">
                <thead>
                    <tr class="bg-gray-50/80 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Trabajador
                        </th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">
                            Sueldo Base</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-orange-400 text-center">
                            Adelantos</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-rose-500 text-center">
                            Faltas</th>
                        <th
                            class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-emerald-500 text-center">
                            A Recibir (Neto)</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Fecha de Pago
                        </th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Estado</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">
                            Acción</th>
                    </tr>
                </thead>
                <tbody id="tabla-paginada" class="divide-y divide-gray-50 dark:divide-gray-800/80">
                    @foreach ($staffMembers as $staff)
                        @php
                            $inicial = mb_strtoupper(mb_substr($staff->name, 0, 1) . mb_substr($staff->surname, 0, 1));
                            $neto = $staff->salary - $staff->advance_payment - $staff->absence_discount;

                            $payDate = \Carbon\Carbon::create($today->year, $today->month, $staff->payment_day ?? 30);
                            $diffDays = $today->copy()->startOfDay()->diffInDays($payDate, false);

                            $estado = 'Pendiente';
                            $estadoClasses =
                                'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400 border border-amber-200 dark:border-amber-500/30';
                            $estadoIcon = '<span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>';

                            $yaPagado = in_array($staff->id, $paidStaffIds);

                            if ($diffDays < 0) {
                                $diffText = 'Hace ' . abs($diffDays) . ' días';
                                if (abs($diffDays) == 1) {
                                    $diffText = 'Ayer';
                                }
                            } elseif ($diffDays == 0) {
                                $diffText = 'Hoy';
                            } else {
                                $diffText = 'En ' . $diffDays . ' días';
                                if ($diffDays == 1) {
                                    $diffText = 'Mañana';
                                }
                            }

                            // Si ya fue pagado en la base de datos (ignora diffDays)
                            if ($yaPagado) {
                                $estado = 'Pagado';
                                $estadoClasses =
                                    'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30';
                                $estadoIcon =
                                    '<i data-lucide="check" class="w-2.5 h-2.5"></i>';
                            } else {
                                // Aún no ha sido pagado, ¿Le toca hoy?
                                if ($diffDays <= 0) {
                                    $estado = 'Para Hoy';
                                    $estadoClasses =
                                        'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30';
                                    $estadoIcon =
                                        '<span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>';
                                }
                            }
                        @endphp
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors fila-paginada">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-200 dark:border-gray-700">
                                        <span
                                            class="text-xs font-black text-gray-700 dark:text-gray-300">{{ $inicial }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $staff->name }}
                                            {{ $staff->surname }}</p>
                                        <p class="text-[10px] text-gray-400">{{ $staff->position }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-300">S/
                                    {{ number_format($staff->salary, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($staff->advance_payment > 0)
                                    <span
                                        class="text-sm font-bold text-orange-500 bg-orange-50 dark:bg-orange-500/10 px-2 py-1 rounded-md">-
                                        S/ {{ number_format($staff->advance_payment, 2) }}</span>
                                @else
                                    <span class="text-sm font-bold text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($staff->pending_absences_count > 0)
                                    <div class="flex flex-col items-center justify-center">
                                        <span class="text-xs font-black text-rose-500 bg-rose-50 dark:bg-rose-500/10 px-2 py-0.5 rounded-md mb-1">{{ $staff->pending_absences_count }}d</span>
                                        <span class="text-[10px] font-bold text-rose-400">- S/ {{ number_format($staff->absence_discount, 2) }}</span>
                                    </div>
                                @else
                                    <span class="text-sm font-bold text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-black text-emerald-600 dark:text-emerald-400">S/
                                    {{ number_format($neto, 2) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-gray-700 dark:text-gray-300">
                                    {{ $payDate->format('d M Y') }}</p>
                                <p class="text-[10px] {{ $diffDays < 0 ? 'text-gray-400' : 'text-blue-500' }} font-bold">
                                    {{ $diffText }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $estadoClasses }}">
                                    {!! $estadoIcon !!} {{ $estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if ($estado == 'Pagado')
                                    <span class="text-[11px] font-bold text-emerald-500/80 italic">—</span>
                                @elseif($estado == 'Para Hoy')
                                    <button type="button" onclick="marcarPagado(this, {{ $staff->id }})"
                                        class="text-[11px] font-black bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-4 py-2 rounded-xl hover:scale-105 transition-transform shadow-lg shadow-gray-900/20 dark:shadow-white/10 uppercase tracking-wide flex items-center justify-center gap-1">Pagar</button>
                                @else
                                    <span class="text-[11px] font-medium text-gray-400 dark:text-gray-500 italic">No
                                        disponible</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($staffMembers->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 dark:text-gray-400">No hay personal registrado en el sistema. Ejecuta los
                        seeders.</p>
                </div>
            @endif
        </div>
    </div>
</div>

    <script>
        function marcarPagado(btn, staffId) {
            // Feedback visual rápido
            let w = btn.offsetWidth;
            btn.style.width = w + 'px'; // Fix width for animation
            btn.innerHTML =
                '<i data-lucide="loader-2" class="animate-spin h-3.5 w-3.5 inline"></i>';
            if(window.lucide) window.lucide.createIcons();

            // Post real a la base de datos
            fetch(`/dashboard/staffReport/pay/${staffId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        let container = btn.parentElement;
                        container.innerHTML =
                            '<span class="text-[11px] font-bold text-emerald-500/80 italic">—</span>';

                        let row = container.closest('tr');
                        let estadoTd = row.querySelectorAll('td')[5];
                        if (estadoTd) {
                            estadoTd.innerHTML =
                                '<span class="animate-in fade-in zoom-in duration-300 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-amber-400 border border-emerald-200 dark:border-emerald-500/30"><i data-lucide="check" class="w-2.5 h-2.5"></i> Pagado</span>';
                            if(window.lucide) window.lucide.createIcons();
                        }
                    }
                })
                .catch(error => {
                    alert('Hubo un error al registrar el pago');
                    console.error(error);
                    btn.innerHTML = 'Pagar';
                });
        }

        // Buscador Front-End para Tabla de Pagos
        document.getElementById('searchInput')?.addEventListener('input', function(e) {
            let filter = e.target.value.toLowerCase();
            let rows = document.querySelectorAll('#tabla-paginada tr.fila-paginada');

            rows.forEach(row => {
                // Buscamos en todas las celdas de la fila (principalmente Trabajador y Fecha)
                let textContent = row.textContent.toLowerCase();
                if (textContent.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
