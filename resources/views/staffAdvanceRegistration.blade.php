@extends('layouts.app')

@section('content')
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="banknote" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Registrar Adelanto</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Asignación de monto a descontar</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/dashboard/staffReport') }}"
                    class="flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all active:scale-95">
                    <i data-lucide="chevron-left" class="w-[18px] h-[18px]"></i>
                    Volver a Reportes
                </a>
            </div>
        </div>
    </div>

    <div
        class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden max-w-2xl mx-auto">
        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-lg font-black text-gray-800 dark:text-white italic">Detalles del Adelanto</h3>
            <p class="text-sm text-gray-500 mt-1">Selecciona al trabajador y define el monto a descontar el día de pago.</p>
        </div>

        @if ($errors->any())
            <div
                class="mx-8 mt-6 px-5 py-4 bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-800 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-600 dark:text-red-400 font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/dashboard/staffAdvanceRegistration/store') }}" method="POST" class="p-8">
            @csrf
            <div class="grid grid-cols-1 gap-6">

                {{-- Personal --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Trabajador <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="staff_id" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer">
                            <option value="">Seleccione un trabajador...</option>
                            @foreach ($staffMembers as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->name }} {{ $staff->surname }} ({{ $staff->position }})
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                {{-- Monto del Adelanto --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Monto (S/) <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold sm:text-sm">S/</span>
                        </div>
                        <input type="number" step="0.01" name="amount" required value="{{ old('amount') }}"
                            placeholder="0.00"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-black text-lg text-orange-600">
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1 italic">El monto se sumará a cualquier adelanto previo no
                        pagado.</p>
                </div>

            </div>

            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ url('/dashboard/staffreport') }}"
                    class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-800 dark:hover:text-white transition-all">Cancelar</a>
                <button type="submit"
                    class="flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:scale-[1.02] active:scale-95 shadow-lg shadow-orange-500/25 transition-all">
                    <i data-lucide="save" class="w-[18px] h-[18px]"></i>
                    Añadir Adelanto
                </button>
            </div>
        </form>
    </div>
@endsection
