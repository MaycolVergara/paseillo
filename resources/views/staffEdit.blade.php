@extends('layouts.app')

@section('content')
    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="user-cog" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Editar Personal</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Actualiza los datos del equipo</p>
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

    <div class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden max-w-4xl mx-auto">
        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-lg font-black text-gray-800 dark:text-white italic">Información del Trabajador</h3>
            <p class="text-sm text-gray-500 mt-1">Actualiza los datos requeridos en el sistema.</p>
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

        <form action="{{ url('/dashboard/staff/update/' . $staff->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nombre --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="user" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="text" name="name" required value="{{ old('name', $staff->name) }}" placeholder="Ej. Maycol" class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                {{-- Apellido --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Apellido <span class="text-red-500">*</span></label>
                    <input type="text" name="surname" required value="{{ old('surname', $staff->surname) }}" placeholder="Ej. Vergara" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                </div>

                {{-- DNI --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">DNI / Documento <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="id-card" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="text" name="dni" required value="{{ old('dni', $staff->dni) }}"
                               placeholder="8 dígitos" maxlength="8" minlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8)"
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                {{-- Cargo --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Cargo / Posición <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="position" required class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer">
                            <option value="Administrador" {{ old('position', $staff->position) == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="Mozo" {{ old('position', $staff->position) == 'Mozo' ? 'selected' : '' }}>Mozo</option>
                            <option value="Cocinero" {{ old('position', $staff->position) == 'Cocinero' ? 'selected' : '' }}>Cocinero</option>
                            <option value="Limpieza" {{ old('position', $staff->position) == 'Limpieza' ? 'selected' : '' }}>Limpieza</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                {{-- Sueldo --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Sueldo Mensual <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold sm:text-sm">S/</span>
                        </div>
                        <input type="number" step="0.01" name="salary" required value="{{ old('salary', $staff->salary) }}" placeholder="0.00" class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-black text-lg text-orange-600">
                    </div>
                </div>



                {{-- Día de Pago --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Día de Pago (Mensual)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="calendar" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="number" name="payment_day" min="1" max="31" value="{{ old('payment_day', $staff->payment_day) }}" placeholder="Día (ej. 15)" class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                {{-- Fecha de Ingreso --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Fecha de Ingreso</label>
                    <input type="date" name="hire_date" value="{{ old('hire_date', $staff->hire_date) }}" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium cursor-pointer">
                </div>

                {{-- Teléfono --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Teléfono / WhatsApp</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="phone" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="text" name="phone" value="{{ old('phone', $staff->phone) }}" placeholder="987 654 321" maxlength="9" minlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9)" class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Correo Electrónico Personal</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="mail" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email', $staff->email) }}" placeholder="ejemplo@correo.com" class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                {{-- Dirección (Ancho completo) --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Dirección de Domicilio</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="map-pin" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="text" name="address" value="{{ old('address', $staff->address) }}" placeholder="Ej. Av. Principal 123, Huanta" class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ url('/dashboard/staffList') }}" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-800 dark:hover:text-white transition-all">Cancelar</a>
                <button type="submit" class="flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:scale-[1.02] active:scale-95 shadow-lg shadow-orange-500/25 transition-all">
                    <i data-lucide="save" class="w-[18px] h-[18px]"></i>
                    Actualizar Trabajador
                </button>
            </div>
        </form>
    </div>
@endsection
