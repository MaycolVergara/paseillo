@extends('layouts.app')

@section('content')
    {{-- Encabezado Compacto --}}
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-800 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Catálogo
                        Paseillo</h2>
                    <p class="text-xs text-gray-500 font-medium">Gestión rápida de menú y stock.</p>
                </div>
            </div>

            <div class="flex flex-1 max-w-md items-center gap-3">
                <div class="relative w-full">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle
                                cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Buscar pizza, burger..."
                           class="w-full pl-9 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all outline-none dark:text-white">
                </div>
                {{-- Ruta: productoRegistro -> productRegistration --}}
                <a href="{{ url('/dashboard/productRegistration') }}"
                   class="whitespace-nowrap flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:shadow-orange-500/40 shadow-lg transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Nuevo Producto
                </a>
            </div>
        </div>
    </div>

    {{-- Tabla Optimizada --}}
    <div
        class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400">Producto</th>
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400">Precio</th>
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400 text-center">
                        Categoría
                    </th>
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400">Estado</th>
                    <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400 text-right">
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody id="tabla-paginada" class="divide-y divide-gray-50 dark:divide-gray-800">
                {{-- $productos -> $products --}}
                @foreach($products as $product)
                    <tr class="group hover:bg-orange-50/30 dark:hover:bg-orange-900/5 transition-all fila-paginada">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                                    @php
                                        // Relación category en lugar de categorias->where
                                        $catName = $product->category ? strtolower($product->category->name) : strtolower($product->name);
                                        $emoji = '🍽️';

                                        if (str_contains($catName, 'pizza')) { $emoji = '🍕'; }
                                        elseif (str_contains($catName, 'hamburguesa') || str_contains($catName, 'burger')) { $emoji = '🍔'; }
                                        elseif (str_contains($catName, 'bebida') || str_contains($catName, 'gaseosa') || str_contains($catName, 'refresco')) { $emoji = '🥤'; }
                                        elseif (str_contains($catName, 'krispy') || str_contains($catName, 'pollo') || str_contains($catName, 'broaster')) { $emoji = '🍗'; }
                                        elseif (str_contains($catName, 'salchipapa') || str_contains($catName, 'papas')) { $emoji = '🍟'; }
                                        elseif (str_contains($catName, 'alitas')) { $emoji = '🍗'; }
                                    @endphp

                                    {{ $emoji }}
                                </div>
                                <div>
                                    {{-- nombre_producto -> name --}}
                                    <p class="text-sm font-bold text-gray-900 dark:text-white texto-buscar">{{ $product->name }}</p>
                                    {{-- descripcion_producto -> description --}}
                                    <p class="text-[11px] text-gray-400 line-clamp-1 max-w-[150px] italic">{{ $product->description }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{-- precio -> price --}}
                            <span
                                class="text-sm font-black text-emerald-600 dark:text-emerald-400">S/ {{ number_format($product->price, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $product->category ? 'bg-orange-100 text-orange-600 dark:bg-orange-900/30' : 'bg-gray-100 text-gray-500' }}">
                                {{ $product->category ? $product->category->name : 'Sin Categoria' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                {{-- fecha_entrega -> delivery_date --}}
                                <span
                                    class="w-1.5 h-1.5 rounded-full {{ $product->delivery_date ? 'bg-blue-500' : 'bg-amber-500' }}"></span>
                                <p class="text-[10px] font-bold text-gray-500 dark:text-gray-400">{{ $product->delivery_date ?? 'Inmediata' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right relative">
                            <div class="inline-block text-left group/menu relative">
                                <button
                                    class="p-2 rounded-xl text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-orange-600 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="12" cy="5" r="1"/>
                                        <circle cx="12" cy="19" r="1"/>
                                    </svg>
                                </button>

                                <div
                                    class="absolute right-0 top-full mt-2 w-36 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl z-50 invisible group-hover/menu:visible opacity-0 group-hover/menu:opacity-100 transition-all duration-200 transform origin-top-right scale-95 group-hover/menu:scale-100 overflow-hidden">
                                    <div class="p-1.5 space-y-1">
                                        {{-- Ruta: productos/{id}/editar -> products/{id}/edit --}}
                                        <a href="{{ url('/dashboard/products/' . $product->id . '/edit') }}"
                                           class="flex items-center gap-2.5 w-full px-3 py-2 text-xs font-bold text-gray-600 dark:text-gray-300 hover:bg-orange-50 dark:hover:bg-orange-950/30 hover:text-orange-600 rounded-xl transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                                                <path d="m15 5 4 4"/>
                                            </svg>
                                            Editar
                                        </a>
                                        {{-- Ruta: productos/{id}/eliminar -> products/{id}/delete --}}
                                        <form action="{{ url('/dashboard/products/' . $product->id . '/delete') }}"
                                              method="POST" class="block">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Eliminar producto?')"
                                                    class="flex items-center gap-2.5 w-full px-3 py-2 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-xl transition-all text-left">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18"/>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                                    <line x1="10" x2="10" y1="11" y2="17"/>
                                                    <line x1="14" x2="14" y1="11" y2="17"/>
                                                </svg>
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div id="paginacion-contenedor"
             class="px-6 py-3 border-t border-gray-100 dark:border-gray-800 flex justify-center items-center bg-gray-50/30 dark:bg-gray-800/20">
        </div>
    </div>
@endsection
