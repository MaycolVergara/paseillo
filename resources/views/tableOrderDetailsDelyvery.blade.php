@extends('layouts.app')

@section('content')
    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-3xl p-5 md:p-6 shadow-card border border-gray-100 dark:border-gray-800 mb-6">

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-red-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Delivery Paseillo</h2>
                    <p class="text-xs text-gray-500 font-medium">Gestión de pedidos para reparto.</p>
                </div>
            </div>

            {{-- BOTÓN VOLVER (Corregido con /dashboard/) --}}
            <a href="{{ url('/dashboard/customerTableDelyveryView') }}"
               class="px-6 py-3 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 rounded-xl text-sm font-black hover:bg-gray-200 dark:hover:bg-gray-700 transition-all shadow-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                Volver a Delivery
            </a>
        </div>

        {{-- FORMULARIO GUARDAR (Corregido con /dashboard/saveOrderDelivery/) --}}
        <form action="{{ url('/dashboard/saveOrderDelivery/' . $id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-4 items-end">
                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Producto</label>
                    <div class="relative">
                        <select name="product_id" id="select-producto" required
                                class="w-full pl-3 pr-8 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all cursor-pointer appearance-none">
                            <option value="" disabled selected>Seleccion...</option>
                            @foreach($products as $producto)
                                <option value="{{ $producto->id }}" data-precio="{{ $producto->price }}">
                                    {{ $producto->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Personalizado</label>
                    <input type="text" name="customization" placeholder="Sin cremas..."
                           class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 focus:outline-none focus:border-red-500">
                </div>

                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Precio Unid.</label>
                    <input type="number" id="input-precio-unidad" readonly
                           class="w-full px-3 py-2.5 bg-gray-100 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-500 dark:text-gray-400 outline-none cursor-not-allowed">
                </div>

                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Cantidad</label>
                    <input type="number" name="quantity" id="input-cantidad" min="1" value="1" required
                           class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all text-center">
                </div>

                <div class="lg:col-span-1">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Total</label>
                    <input type="number" id="input-total" readonly
                           class="w-full px-3 py-2.5 bg-red-50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/50 rounded-xl text-sm font-black text-red-600 dark:text-red-500 outline-none cursor-not-allowed text-center">
                </div>

                <div class="lg:col-span-2">
                    <button type="submit"
                            class="w-full py-2.5 bg-gradient-to-b from-red-500 to-red-600 hover:from-red-600 text-white text-sm font-black rounded-xl shadow-lg transition-all active:scale-95 flex items-center justify-center h-[42px]">
                        Guardar Pedido Delivery
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100 dark:border-gray-800">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 grid grid-cols-3 items-center">
            <h3 class="text-lg font-black text-gray-800 dark:text-gray-100 whitespace-nowrap">Registro de Producto</h3>
            <div class="flex justify-center">
                <span class="px-4 py-1 bg-red-100 dark:bg-red-950/40 text-red-600 dark:text-red-400 text-3xl font-black rounded-full uppercase tracking-wider shadow-sm">
                    DELIVERY {{ $id }}
                </span>
            </div>
            <div class="hidden md:block"></div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                <tr class="bg-gray-50/80 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Producto</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Personalizado</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Cantidad</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400">Subtotal</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Acción</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                @forelse($saleDetails as $detalle)
                    <tr class="group hover:bg-red-50/30 dark:hover:bg-red-950/10 transition-all">
                        <td class="px-6 py-4 text-sm font-bold text-gray-700 dark:text-gray-200">{{ $detalle->product->name ?? '---' }}</td>
                        <td class="px-6 py-4 text-xs font-medium text-gray-500 dark:text-gray-400 italic">{{ $detalle->customization ?? '---' }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-800 text-sm font-black text-gray-800 dark:text-white">{{ $detalle->quantity }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-black text-gray-800 dark:text-white">S/ {{ number_format($detalle->subtotal, 2) }}</td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ url('/dashboard/deleteDetail/' . $detalle->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Quitar del delivery?')" class="px-4 py-1.5 bg-red-500 text-white text-xs font-bold rounded-lg transition-all active:scale-95">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-sm font-medium text-gray-400">No hay productos todavía.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-5 bg-gray-50/50 dark:bg-gray-800/30 border-t border-gray-100 dark:border-gray-800 flex flex-col lg:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2">
                <span class="text-xl font-bold text-gray-800 dark:text-gray-200">Total:</span>
                <span class="text-2xl font-black text-gray-900 dark:text-white italic">S/ {{ number_format($overallTotal ?? 0, 2) }}</span>
            </div>

            <div class="flex flex-col md:flex-row items-end gap-4 w-full lg:w-auto">
                <a href="{{ url('/dashboard/issueReceipt/' . $id) }}" target="_blank" class="w-full md:w-auto px-6 py-3 bg-red-500 text-white text-sm font-bold rounded-xl shadow-lg text-center flex items-center justify-center h-[46px]">Emitir Boleta</a>

                {{-- FORMULARIO FINALIZAR (Corregido con /dashboard/finalizeSaleDelivery/) --}}
                <form action="{{ url('/dashboard/finalizeSaleDelivery/' . $id) }}" method="POST" class="flex flex-col md:flex-row items-end gap-4 w-full md:w-auto">
                    @csrf
                    <div class="w-full md:w-48">
                        <select name="payment_method" required class="w-full bg-white dark:bg-gray-900 border border-gray-200 rounded-xl px-4 py-2.5 font-bold text-sm h-[46px]">
                            <option value="Cash" selected>💵 Efectivo</option>
                            <option value="Yape">📱 Yape / Plin</option>
                        </select>
                    </div>
                    @if(Auth::user()->role_id == 1)
                        <button type="submit" onclick="return confirm('¿Finalizar pedido y liberar unidad?')" class="w-full md:w-auto px-8 py-3 bg-emerald-500 text-white text-sm font-bold rounded-xl shadow-lg h-[46px]">Finalizar Delivery</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('select-producto').addEventListener('change', function() {
            const precio = this.options[this.selectedIndex].getAttribute('data-precio');
            document.getElementById('input-precio-unidad').value = precio;
            calcularTotal();
        });
        document.getElementById('input-cantidad').addEventListener('input', calcularTotal);
        function calcularTotal() {
            const precio = document.getElementById('input-precio-unidad').value || 0;
            const cantidad = document.getElementById('input-cantidad').value || 0;
            document.getElementById('input-total').value = (precio * cantidad).toFixed(2);
        }
    </script>
@endsection
