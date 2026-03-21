@extends('layouts.app')

@section('content')
    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight italic">Inventario Paseillo</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lista completa de productos y control de stock.</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- Ruta: productoRegistro -> productRegistration --}}
                <a href="{{ url('/dashboard/productRegistration') }}"
                   class="flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:shadow-orange-500/40 shadow-lg transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nuevo Producto
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                    <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-gray-400">Producto</th>
                    <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-gray-400">Categoría</th>
                    <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-gray-400">Precio</th>
                    <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-gray-400 text-right">Acciones</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                {{-- $productos -> $products --}}
                @foreach($products as $product)
                    <tr class="group hover:bg-gray-50/50 transition-all">
                        <td class="px-8 py-6">
                            <p class="text-lg font-extrabold text-gray-900 dark:text-white tracking-tight">
                                {{-- nombre_producto -> name --}}
                                {{ $product->name }}
                            </p>
                        </td>
                        <td class="px-8 py-6">
                            {{-- Relación categoria -> category y nombre_categoria -> name --}}
                            <span class="px-3 py-1 bg-orange-50 dark:bg-orange-950/30 text-orange-600 dark:text-orange-400 text-xs font-bold rounded-lg border border-orange-100 dark:border-orange-900/50">
                                {{ $product->category->name ?? 'Sin Categoría' }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            {{-- precio -> price --}}
                            <p class="text-lg font-black text-gray-800 dark:text-gray-200">S/ {{ number_format($product->price, 2) }}</p>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                {{-- productos/{id}/editar -> products/{id}/edit --}}
                                <a href="{{ url('/dashboard/products/'.$product->id.'/edit') }}"
                                   class="p-2.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:text-orange-600 rounded-xl transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                </a>

                                {{-- productos/{id}/eliminar -> products/{id}/delete --}}
                                <form action="{{ url('/dashboard/products/'.$product->id.'/delete') }}" method="POST" onsubmit="return confirm('¿Eliminar producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2.5 bg-red-50 dark:bg-red-950/30 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
