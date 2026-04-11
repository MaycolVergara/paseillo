@extends('layouts.app')

@section('content')
    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gradient-to-br from-rose-600 to-pink-700 rounded-2xl flex items-center justify-center text-white shadow-sm shadow-rose-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight italic">Registrar Inasistencia</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Selecciona el trabajador y la fecha en la que faltó para descontar su día.</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/dashboard/staffreport') }}" class="flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Volver a Reportes
                </a>
            </div>
        </div>
    </div>

    <div class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden max-w-2xl mx-auto">
        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-black text-gray-800 dark:text-white italic">Detalles de la Falta</h3>
                <p class="text-sm text-gray-500 mt-1">La inasistencia será retenida del sueldo final del mes actual.</p>
            </div>
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

        <form action="{{ url('/dashboard/staffAbsenceRegistration/store') }}" method="POST" class="p-8">
            @csrf
            <div class="grid grid-cols-1 gap-6">

                {{-- Personal --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Trabajador <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="staff_id" id="staffSelect" required class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all dark:text-white font-bold appearance-none cursor-pointer">
                            <option value="" data-salary="0.00" data-advance="0.00">Seleccione un trabajador...</option>
                            @foreach($staffMembers as $staff)
                                <option value="{{ $staff->id }}" 
                                    data-salary="{{ $staff->salary }}" 
                                    data-advance="{{ $staff->advance_payment }}"
                                    {{ old('staff_id') == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->name }} {{ $staff->surname }} ({{ $staff->position }})
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Widget de Perfil (Dynamic) --}}
                <div id="staffInfoWidget" class="hidden bg-gray-50 dark:bg-gray-800/50 p-4 rounded-xl border border-gray-200 dark:border-gray-700 flex flex-wrap gap-4 justify-between items-center">
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Sueldo Base Mensual</p>
                        <p class="text-lg font-black text-gray-900 dark:text-white">S/ <span id="displaySalary">0.00</span></p>
                    </div>
                    <div>
                        <p class="text-xs text-rose-500 font-medium uppercase tracking-wider">Adelantos Activos</p>
                        <p class="text-lg font-black text-rose-600">S/ <span id="displayAdvance">0.00</span></p>
                    </div>
                    <div class="w-full h-px bg-gray-200 dark:bg-gray-700 my-1"></div>
                    <div class="w-full">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Cálculo de penalidad diaria</p>
                        <p class="text-sm font-bold text-gray-700 dark:text-gray-300">S/ <span id="displayDailyWage">0.00</span> <span class="text-xs font-normal text-gray-400">/día</span></p>
                    </div>
                </div>

                {{-- Fecha de Inasistencia --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Fecha Exacta de la Falta <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="date" name="absence_date" required value="{{ old('absence_date') ?? \Carbon\Carbon::today()->format('Y-m-d') }}" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all dark:text-white font-black text-gray-700 cursor-pointer">
                    </div>
                </div>

                {{-- Notas Opcionales --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Observaciones</label>
                    <input type="text" name="notes" value="{{ old('notes') }}" placeholder="Motivo o detalle (ej. No se comunicó / Permiso médico sin goce)" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 outline-none transition-all dark:text-white font-medium">
                </div>

            </div>

            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ url('/dashboard/staffreport') }}" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-800 dark:hover:text-white transition-all">Cancelar</a>
                <button type="submit" class="flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-rose-600 to-pink-700 hover:scale-[1.02] active:scale-95 shadow-lg shadow-rose-500/25 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Añadir Falta al Registro
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('staffSelect');
            const widget = document.getElementById('staffInfoWidget');
            const dispSalary = document.getElementById('displaySalary');
            const dispAdvance = document.getElementById('displayAdvance');
            const dispDaily = document.getElementById('displayDailyWage');

            function updateWidget() {
                const option = select.options[select.selectedIndex];
                const salary = parseFloat(option.getAttribute('data-salary') || 0);
                const advance = parseFloat(option.getAttribute('data-advance') || 0);

                if (salary > 0 || advance > 0 || select.value !== "") {
                    widget.classList.remove('hidden');
                    dispSalary.textContent = salary.toFixed(2);
                    dispAdvance.textContent = advance.toFixed(2);
                    dispDaily.textContent = (salary / 30).toFixed(2);
                } else {
                    widget.classList.add('hidden');
                }
            }

            select.addEventListener('change', updateWidget);
            updateWidget(); // Run on load in case of old input
        });
    </script>
@endsection
