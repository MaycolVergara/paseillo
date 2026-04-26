@extends('layouts.app')

@section('content')
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-800 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Personal Paseillo</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Gestión de planilla y
                        trabajadores</p>
                </div>
            </div>

            <div class="flex flex-1 max-w-md items-center gap-3">
                <div class="relative w-full">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </span>
                    <input type="text" id="searchInput" placeholder="Buscar por nombre o DNI..."
                        class="w-full pl-9 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all outline-none dark:text-white">
                </div>
                <a href="{{ url('/dashboard/staffRegistration') }}"
                    class="whitespace-nowrap flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:shadow-orange-500/40 shadow-lg transition-all active:scale-95">
                    <i data-lucide="plus" class="w-4.5 h-4.5"></i>
                    Nuevo Trabajador
                </a>
            </div>
        </div>
    </div>

    <div
        class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

        {{-- Alertas de éxito --}}
        @if (session('success'))
            <div
                class="m-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        {{-- Contenedor de la tabla con scroll horizontal para móviles --}}
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse table-auto border-spacing-0 min-w-[800px] md:min-w-full">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400">Trabajador</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400">DNI / ID</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400 text-center">
                            Sueldo</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400 text-center">
                            Cargo / Pago</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400">Estado</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400 text-right">
                            Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-paginada" class="divide-y divide-gray-50 dark:divide-gray-800">
                    @php
                        $sysUsers = $staffMembers
                            ->filter(fn($s) => in_array($s->position, ['Administrador', 'Mozo']) || $s->user)
                            ->sortBy('name');
                        $otherUsers = $staffMembers
                            ->reject(fn($s) => in_array($s->position, ['Administrador', 'Mozo']) || $s->user)
                            ->sortBy('name');
                        $sortedStaffMembers = $sysUsers->concat($otherUsers);
                    @endphp

                    @foreach ($sortedStaffMembers as $staff)
                        {{-- SOLUCIÓN 1: La fila ahora tiene relative y hover:z-50 --}}
                        <tr
                            class="relative hover:z-50 group transition-all fila-paginada {{ $loop->iteration <= 10 ? 'bg-gray-50/40 dark:bg-gray-800/20 shadow-sm' : 'hover:bg-orange-50/30 dark:hover:bg-orange-900/5' }}">
                            <td class="px-6 {{ $loop->iteration <= 10 ? 'py-5' : 'py-4' }}">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="{{ $loop->iteration <= 10 ? 'w-11 h-11' : 'w-10 h-10' }} rounded-xl {{ $staff->user ? 'bg-blue-100 dark:bg-blue-900/40 ring-2 ring-blue-500/50 shadow-sm shadow-blue-500/20' : 'bg-gray-100 dark:bg-gray-800' }} flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                                        <span
                                            class="text-sm font-black {{ $staff->user ? 'text-blue-600 dark:text-blue-400' : 'text-orange-500' }}">{{ mb_strtoupper(mb_substr($staff->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p
                                            class="{{ $loop->iteration <= 10 ? 'text-[15px]' : 'text-sm' }} font-bold text-gray-900 dark:text-white texto-buscar flex items-center gap-1.5">
                                            {{ $staff->name }} {{ $staff->surname }}
                                            @if ($staff->user)
                                                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-blue-500"
                                                    title="Tiene acceso al sistema"></i>
                                            @endif
                                        </p>
                                        <p class="text-[11px] text-gray-400 italic">ID: #{{ $staff->id }}
                                            @if ($staff->hire_date)
                                                • Ingreso:
                                                {{ \Carbon\Carbon::parse($staff->hire_date)->format('d/m/Y') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400 italic texto-buscar">
                                {{ $staff->dni }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-black text-emerald-600 dark:text-emerald-400">
                                    S/ {{ number_format($staff->salary, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center gap-1">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-black uppercase tracking-wider bg-orange-100 text-orange-600 dark:bg-orange-900/30">
                                        {{ $staff->position }}
                                    </span>
                                    @if ($staff->payment_day)
                                        <p class="text-[10px] font-bold text-gray-500 dark:text-gray-400">Cobro: Día
                                            {{ $staff->payment_day }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full {{ $staff->is_active ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                    <p
                                        class="text-[10px] font-bold {{ $staff->is_active ? 'text-emerald-600' : 'text-red-500' }} uppercase">
                                        {{ $staff->is_active ? 'Activo' : 'Inactivo' }}
                                    </p>
                                </div>
                            </td>

                            {{-- SOLUCIÓN 2: Las acciones corregidas sin invisible y con pointer-events --}}
                            <td class="px-6 py-4 text-right">
                                <div class="inline-block text-left group/menu relative z-20">
                                    <button
                                        class="p-2 rounded-xl text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-orange-600 transition-all">
                                        <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                    </button>

                                    <div
                                        class="absolute right-0 top-full pt-1 w-48 z-[100] opacity-0 pointer-events-none group-hover/menu:opacity-100 group-hover/menu:pointer-events-auto transition-all duration-200 transform origin-top-right scale-95 group-hover/menu:scale-100">

                                        <div
                                            class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-2xl overflow-hidden p-1.5 space-y-1 relative">

                                            {{-- Generar Credenciales --}}
                                            <a href="{{ url('/dashboard/staff/' . $staff->id . '/credentials') }}"
                                                class="flex items-center gap-2.5 w-full px-3 py-2.5 text-xs font-bold text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-950/30 rounded-xl transition-all">
                                                <i data-lucide="key" class="w-3.5 h-3.5"></i>
                                                {{ $staff->user ? 'Actualizar Cred.' : 'Generar Credenciales' }}
                                            </a>

                                            {{-- Activar/Desactivar --}}
                                            <form action="{{ url('/dashboard/staff/status/' . $staff->id) }}"
                                                method="POST">
                                                @csrf @method('PATCH')
                                                @if ($staff->is_active)
                                                    <button type="submit"
                                                        class="flex items-center gap-2.5 w-full px-3 py-2.5 text-xs font-bold text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-xl transition-all text-left">
                                                        <i data-lucide="power" class="w-3.5 h-3.5"></i>
                                                        Desactivar Cuenta
                                                    </button>
                                                @else
                                                    <button type="submit"
                                                        class="flex items-center gap-2.5 w-full px-3 py-2.5 text-xs font-bold text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 rounded-xl transition-all text-left">
                                                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                                                        Activar Cuenta
                                                    </button>
                                                @endif
                                            </form>

                                            {{-- Editar Datos --}}
                                            <a href="{{ url('/dashboard/staff/' . $staff->id . '/edit') }}"
                                                class="flex items-center gap-2.5 w-full px-3 py-2.5 text-xs font-bold text-gray-600 dark:text-gray-300 hover:bg-orange-50 dark:hover:bg-orange-950/30 hover:text-orange-600 rounded-xl transition-all">
                                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                                Editar Datos
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- SOLUCIÓN 3: La paginación debe ir FUERA de la etiqueta <table> --}}
        <div id="paginacion-contenedor"
            class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 flex justify-center items-center bg-gray-50/30 dark:bg-gray-800/20">
        </div>

    </div>
@endsection
