@extends('layouts.app')

@section('content')
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-3xl p-5 md:p-6 shadow-card border border-gray-100 dark:border-gray-800 mb-6 relative z-10">

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Catálogo
                        Paseillo</h2>
                    <p class="text-xs text-gray-500 font-medium">Gestión rápida de menú y stock.</p>
                </div>
            </div>

            <a href="{{ url('/dashboard/tableView') }}"
                class="px-6 py-3 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 rounded-xl text-sm font-black hover:bg-gray-200 dark:hover:bg-gray-700 transition-all shadow-sm flex items-center gap-2">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                Volver a Mesas
            </a>
        </div>

        {{-- Buscador de Productos (Dropdown) --}}
        <form action="{{ url('/dashboard/saveOrder/' . $id) }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-4 items-end">
                {{-- Producto Buscador (Ahora Mas Grande) --}}
                <div class="lg:col-span-2 relative">
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Producto</label>
                    <div class="relative group/search">
                        <input type="text" id="search-producto" placeholder="Buscar producto..."
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all"
                            autocomplete="off">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </div>
                        {{-- Resultados flotantes (Dropdown Reingresado) --}}
                        <div id="search-results" class="search-results-container hidden shadow-2xl">
                            @foreach ($products as $producto)
                                <div class="search-item text-sm font-bold text-gray-700 dark:text-gray-300 border-b border-gray-50 dark:border-gray-800 last:border-0 flex justify-between items-center"
                                    data-id="{{ $producto->id }}" data-nombre="{{ $producto->name }}"
                                    data-precio="{{ $producto->price }}">
                                    <span>{{ $producto->name }}</span>
                                    <span
                                        class="text-[10px] bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 px-2 py-0.5 rounded-md">S/
                                        {{ number_format($producto->price, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <select name="product_id" id="select-producto" required class="hidden">
                        <option value="" disabled selected>Seleccion...</option>
                        @foreach ($products as $producto)
                            <option value="{{ $producto->id }}" data-precio="{{ $producto->price }}">
                                {{ $producto->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="lg:col-span-1">
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Personalizado</label>
                    <input type="text" name="customization" placeholder="Sin cremas..."
                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 focus:outline-none focus:border-orange-500">
                </div>

                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Precio
                        Unid.</label>
                    <input type="number" id="input-precio-unidad" readonly
                        class="w-full px-3 py-2.5 bg-gray-100 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-500 dark:text-gray-400 outline-none cursor-not-allowed">
                </div>

                <div class="lg:col-span-1">
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Cantidad</label>
                    <input type="number" name="quantity" id="input-cantidad" min="1" value="1" required
                        class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-4 focus:ring-orange-500/10 outline-none transition-all text-center">
                </div>

                <div class="lg:col-span-1">
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Subtotal</label>
                    <input type="number" id="input-total" readonly
                        class="w-full px-3 py-2.5 bg-orange-50 dark:bg-orange-950/20 border border-orange-200 dark:border-orange-900/50 rounded-xl text-sm font-black text-orange-600 dark:text-orange-500 outline-none cursor-not-allowed text-center">
                </div>

                <div class="lg:col-span-1">
                    <button type="submit"
                        class="w-full py-2.5 bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm font-black rounded-xl shadow-lg transition-all active:scale-95 flex items-center justify-center h-[46px]">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div
        class="animate-in delay-2 bg-white dark:bg-gray-900
         rounded-3xl shadow-card border border-gray-100
         dark:border-gray-800 s">

        <div
            class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-4">
            <h3 class="text-lg font-black text-gray-800 dark:text-gray-100 whitespace-nowrap order-2 sm:order-1">
                Registro de Producto
            </h3>

            <div class="flex justify-center order-1 sm:order-2">
                <span
                    class="px-6 py-2 bg-emerald-100 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 text-2xl sm:text-3xl font-black rounded-2xl uppercase tracking-wider shadow-sm border border-emerald-200 dark:border-emerald-800/50">
                    Mesa {{ $id }}
                </span>
            </div>

            {{-- Espaciador para equilibrio visual en desktop --}}
            <div class="hidden lg:block w-32"></div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/80 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Producto</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Personalizado
                        </th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Precio Unidad
                        </th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">
                            Cantidad
                        </th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Subtotal</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">
                            Acción
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @forelse($saleDetails as $detalle)
                        <tr class="group hover:bg-orange-50/30 dark:hover:bg-orange-950/10 transition-all">
                            <td class="px-6 py-4 text-sm font-bold text-gray-700 dark:text-gray-200">
                                {{ $detalle->product->name ?? 'Producto Eliminado' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-gray-500 dark:text-gray-400 italic">
                                {{ $detalle->customization ?? '---' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400">
                                S/ {{ number_format($detalle->unit_price, 2) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 text-sm font-black text-gray-800 dark:text-white">
                                    {{ $detalle->quantity }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-black text-gray-800 dark:text-white">
                                S/ {{ number_format($detalle->subtotal, 2) }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ url('/dashboard/deleteDetail/' . $detalle->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Quitar este producto de la cuenta?')"
                                        class="px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-lg shadow-sm shadow-red-500/20 transition-all active:scale-95">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm font-medium text-gray-400">
                                <span class="block text-sm font-bold text-gray-300 mb-2">Sin productos</span>
                                No hay productos en esta orden todavía.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div
            class="px-6 py-5 bg-gray-50/50 dark:bg-gray-800/30 border-t border-gray-100 dark:border-gray-800 flex flex-col lg:flex-row items-center justify-between gap-6">

            {{-- Lado Izquierdo: Total --}}
            <div class="flex items-center gap-2">
                <span class="text-xl font-bold text-gray-800 dark:text-gray-200">Total:</span>
                <span class="text-2xl font-black text-gray-900 dark:text-white italic">
                    S/ {{ number_format($overallTotal ?? 0, 2) }}
                </span>
            </div>

            {{-- Lado Derecho: Acciones en una sola línea --}}
            <div class="flex flex-col md:flex-row items-end gap-4 w-full lg:w-auto">

                {{-- Botón Emitir Ticket --}}
                <a href="{{ url('/dashboard/issueReceipt/' . $id) }}" target="_blank"
                    class="w-full md:w-auto px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-amber-500/20 transition-all active:scale-95 text-center flex items-center justify-center whitespace-nowrap h-[46px]">
                    Emitir Ticket
                </a>

                @if (Auth::user()->role_id == 1)
                    {{-- Botón Emitir Boleta --}}
                    <a href="{{ url('/dashboard/customerBallot/' . $id) }}" target="_blank"
                        class="w-full md:w-auto px-6 py-3 bg-blue-500
                hover:bg-blue-600 text-white text-sm font-bold
                rounded-xl shadow-lg shadow-blue-500/20 transition-all
                 active:scale-95 text-center flex items-center justify-center whitespace-nowrap h-[46px]">
                        Emitir Boleta
                    </a>
                @endif



                {{-- Formulario que agrupa Pago y Finalizar --}}
                @if (Auth::user()->role_id == 1)
                <form action="{{ url('/dashboard/finalizeSale/' . $id) }}" method="POST"
                    class="flex flex-col md:flex-row items-end gap-4 w-full md:w-auto"
                    onsubmit="return confirm('Seguro que deseas cobrar esta cuenta y liberar la mesa?')">
                    @csrf

                    {{-- Selector de Método de Pago --}}
                    <div class="w-full md:w-48">
                        <label
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Método
                            de Pago</label>
                        <div class="relative">
                            <select name="payment_method" required
                                class="w-full appearance-none bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 rounded-xl px-4 py-2.5 outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition-all cursor-pointer font-bold text-sm h-[46px]">
                                <option value="cash" selected>Efectivo</option>
                                <option value="yape">Yape</option>
                                <option value="card">Tarjeta (POS)</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <i data-lucide="chevron-down" class="h-4 w-4"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Botón Finalizar Venta --}}
                    <button type="submit"
                        class="w-full md:w-auto px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all active:scale-95 whitespace-nowrap h-[46px]">
                        Finalizar Venta
                    </button>
                </form>
                @endif
            </div>
        </div>


    </div>
@endsection
