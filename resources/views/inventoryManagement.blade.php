@extends('layouts.app')

@section('content')
    <div class="space-y-6 animate-in fade-in duration-500">
        {{-- Header --}}
        <div
            class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="package" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Gestión de Stock &
                        Almacén</h2>
                    <p class="text-xs font-medium text-gray-400 mt-0.5 uppercase tracking-widest">Control total de insumos y
                        mercadería</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button onclick="openModal('modalSupply')"
                    class="flex items-center gap-2 px-4 py-2.5 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200 text-sm font-bold rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-100 transition-all">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> Nuevo Insumo
                </button>
                <button onclick="openModal('modalEntry')"
                    class="flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-500 text-white text-sm font-black rounded-xl shadow-lg shadow-red-500/20 hover:scale-[1.02] transition-all">
                    <i data-lucide="package-plus" class="w-4 h-4 text-white"></i> Actualizar Stock
                </button>
            </div>
        </div>

        @if (session('success'))
            <div
                class="p-4 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900 rounded-2xl flex items-center gap-3">
                <div class="bg-emerald-500 text-white p-1 rounded-full"><i data-lucide="check" class="w-4 h-4"></i></div>
                <p class="text-sm font-bold text-emerald-700 dark:text-emerald-400">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6">
            {{-- Listado de Stock --}}
            <div class="space-y-4">
                <div
                    class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 overflow-hidden shadow-sm">
                    <div class="px-6 py-5 border-b border-gray-50 dark:border-gray-800 flex items-center justify-between">
                        <h3 class="font-black text-gray-900 dark:text-white text-base">Insumos en Almacén</h3>
                        <span
                            class="text-[10px] font-black bg-blue-100 text-blue-600 px-2 py-0.5 rounded-md uppercase tracking-widest">{{ $supplies->count() }}
                            Total</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-800/50">
                                    <th class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        Insumo</th>
                                    <th class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        Stock Actual</th>
                                    <th class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        Unidad</th>
                                    <th class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        Estado</th>
                                    <th
                                        class="px-6 py-3 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        Mínimo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                                @foreach ($supplies as $supply)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                                    <i data-lucide="package" class="w-4 h-4 text-gray-500"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-gray-900 dark:text-white">
                                                        {{ $supply->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-black text-base text-gray-800 dark:text-gray-100">
                                            {{ $supply->current_stock }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-xs font-bold text-gray-500 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded-lg">
                                                {{ $supply->unit ?: 'unidad' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($supply->current_stock <= $supply->minimum_stock)
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-widest">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                                    Crítico
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-600 text-[10px] font-black uppercase tracking-widest">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Óptimo
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="text-xs font-bold text-gray-400 italic">Umbral:
                                                {{ $supply->minimum_stock }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL: Registrar Ingreso --}}
    <div id="modalEntry"
        class="fixed inset-0 z-[100] hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div
            class="bg-white dark:bg-gray-900 w-full max-w-md rounded-3xl overflow-hidden shadow-2xl animate-in zoom-in duration-300">
            <div
                class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                <h3 class="font-black text-gray-900 dark:text-white uppercase tracking-tight">Registrar Ingreso de
                    Mercadería</h3>
                <button onclick="closeModal('modalEntry')"
                    class="p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-all"><i data-lucide="x"
                        class="w-5 h-5 text-gray-400"></i></button>
            </div>
            <form action="{{ route('inventory.entry.store') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Seleccionar
                        Insumo</label>
                    <select name="store_id" required
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all">
                        <option value="">Seleccione...</option>
                        @foreach ($supplies as $supply)
                            <option value="{{ $supply->id }}">{{ $supply->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Cantidad
                            que llegó</label>
                        <input type="number" step="0.01" name="quantity" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all"
                            placeholder="Ej: 50">
                    </div>
                    <div>
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Fecha de
                            Ingreso</label>
                        <input type="date" name="entry_date" value="{{ date('Y-m-d') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Notas /
                        Comentarios (Opcional)</label>
                    <textarea name="notes" rows="2"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 focus:ring-2 focus:ring-red-500/20 outline-none transition-all"
                        placeholder="Ej: Llegó de Alicorp..."></textarea>
                </div>
                <button type="submit"
                    class="w-full py-4 bg-gradient-to-r from-red-600 to-red-500 hover:scale-[1.01] transition-all text-white font-black rounded-2xl shadow-lg shadow-red-500/30 uppercase tracking-widest">Confirmar
                    Ingreso</button>
            </form>
        </div>
    </div>

    {{-- MODAL: Registrar Nuevo Insumo --}}
    <div id="modalSupply"
        class="fixed inset-0 z-[100] hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div
            class="bg-white dark:bg-gray-900 w-full max-w-md rounded-3xl overflow-hidden shadow-2xl animate-in zoom-in duration-300">
            <div
                class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                <h3 class="font-black text-gray-900 dark:text-white uppercase tracking-tight">Registrar Nuevo Tipo de Insumo
                </h3>
                <button onclick="closeModal('modalSupply')"
                    class="p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-all"><i data-lucide="x"
                        class="w-5 h-5 text-gray-400"></i></button>
            </div>
            <form action="{{ route('inventory.supply.store') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Nombre del
                        Insumo</label>
                    <input type="text" name="name" required
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all"
                        placeholder="Ej: Pan Molde">
                </div>
                <div>
                    <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Unidad de
                        Medida</label>
                    <select name="unit" required
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all">
                        <option value="">Seleccione...</option>
                        <option value="unidad">Unidad</option>
                        <option value="kg">Kilogramo</option>
                        <option value="litro">Litro</option>
                        <option value="paquete">Paquete</option>
                        <option value="caja">Caja</option>
                        <option value="bolsa">Bolsa</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Stock
                            Inicial</label>
                        <input type="number" name="current_stock" required value="0"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest mb-2">Stock
                            Mínimo</label>
                        <input type="number" name="minimum_stock" required value="10"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all">
                    </div>
                </div>
                <button type="submit"
                    class="w-full py-4 bg-gray-900 hover:bg-black transition-all text-white font-black rounded-2xl shadow-lg shadow-gray-900/40 uppercase tracking-widest">Crear
                    Insumo</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
@endsection
