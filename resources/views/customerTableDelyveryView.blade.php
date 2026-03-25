@extends('layouts.app')

@section('content')

    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-3xl p-5 shadow-sm border border-gray-100 dark:border-gray-800 mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white italic tracking-tight">Panel de Mesas</h2>
                <div class="flex items-center gap-2 mt-1">
                    {{-- Cambiado: $mesasLibres -> $availableTables (si las pasas) o lógica simple --}}
                    <span class="text-[10px] font-black uppercase px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>  Libres
                    </span>
                    <span class="text-[10px] font-black uppercase px-2 py-0.5 bg-red-100 text-red-700 rounded-full flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>  Ocupadas
                    </span>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="relative w-full md:w-64">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </span>
                <input type="text" placeholder="Buscar por número..." class="w-full pl-9 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none">
            </div>
            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-xl text-sm hover:bg-gray-200 transition-all">Volver</a>
        </div>
    </div>

@endsection
