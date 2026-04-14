@extends('layouts.app')

@section('content')
    {{-- Header de la página --}}
    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Acceso al Sistema</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Generando credenciales para {{ $staff->name }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/dashboard/staffList') }}" class="flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all active:scale-95">
                    <i data-lucide="chevron-left" class="w-[18px] h-[18px]"></i>
                    Volver al Listado
                </a>
            </div>
        </div>
    </div>

    {{-- Card del Formulario --}}
    <div class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden max-w-4xl mx-auto">
        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-lg font-black text-gray-800 dark:text-white italic">Generar Credenciales</h3>
            <p class="text-sm text-gray-500 mt-1">Crea un usuario y contraseña para ingresar al software Paseillo.</p>
        </div>

        @if($errors->any())
            <div class="mx-8 mt-6 px-5 py-4 bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-800 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-sm text-red-600 dark:text-red-400 font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/dashboard/staff/' . $staff->id . '/credentials') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nombre Bloqueado (Ocupa las dos columnas como encabezado visual) --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Trabajador Vinculado</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="user-plus" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="text" value="{{ $staff->name }} {{ $staff->surname }} ({{ $staff->position }})" disabled class="w-full pl-11 pr-4 py-3 bg-gray-100 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-500 font-medium cursor-not-allowed">
                    </div>
                </div>

                {{-- Username --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre de Usuario (Login) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="user" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="text" name="username" required value="{{ old('username') }}" placeholder="Ej. mvergara" class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Contraseña <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="lock" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                {{-- Role (Ocupa dos columnas para equilibrar) --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Rol de Acceso en el Sistema <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="role_id" required class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer">
                            <option value="" disabled selected>Selecciona el nivel de permisos...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Botones de acción (Mismo diseño de StaffRegistration) --}}
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ url('/dashboard/staffList') }}" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-800 dark:hover:text-white transition-all">
                    Cancelar
                </a>
                <button type="submit" class="flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 shadow-lg shadow-orange-500/25 transition-all transform hover:scale-[1.02] active:scale-95">
                    <i data-lucide="save" class="w-[18px] h-[18px]"></i>
                    Guardar Acceso
                </button>
            </div>
        </form>
    </div>
@endsection
