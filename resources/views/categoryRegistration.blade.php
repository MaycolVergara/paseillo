@extends('layouts.app')

@section('content')
    {{-- Header de Inventario --}}
    <div class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight italic flex items-center gap-2">
                    <span class="text-orange-500">📦</span> Inventario Paseillo
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Gestión de productos, categorías y precios en tiempo real.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ url('/dashboard/productRegistration') }}"
                   class="flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 shadow-lg shadow-orange-500/25 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nuevo Producto
                </a>
            </div>
        </div>
    </div>

    {{-- Estructura de Panel --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- TABLA DE CATEGORÍAS --}}
        <div class="lg:col-span-2 animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">Nombre</th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 text-right">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="tabla-paginada" class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($categories as $categorie)
                        <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-all fila-paginada">
                            <td class="px-6 py-5">
                                <p class="text-[15px] font-extrabold text-gray-900 dark:text-white">{{ $categorie->name }}</p>
                            </td>

                            <td class="px-6 py-5 text-right relative">
                                <div class="inline-block text-left group/menu relative">
                                    <button class="p-2 rounded-xl text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-orange-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/>
                                        </svg>
                                    </button>
                                    <div class="absolute right-full top-0 mr-2 w-40 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl z-50 invisible group-hover/menu:visible opacity-0 group-hover/menu:opacity-100 transition-all duration-300 transform origin-right scale-95 group-hover/menu:scale-100">
                                        <div class="p-1.5 space-y-1">
                                            {{-- Función JS para cargar datos en el form lateral --}}
                                            <button type="button"
                                                    onclick="prepararEdicionCategoria('{{ $categorie->id }}', '{{ $categorie->name }}')"
                                                    class="flex items-center gap-2 w-full px-3 py-2.5 text-xs font-black text-gray-700 dark:text-gray-300 hover:bg-orange-50 hover:text-orange-600 rounded-xl transition-all text-left">
                                                Editar
                                            </button>

                                            <form action="{{ url('/dashboard/categoryRegistration/' . $categorie->id) }}" method="POST"
                                                  onsubmit="return confirm('¿Eliminar categoría? Esto afectará a sus productos.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center gap-2 w-full px-3 py-2.5 text-xs font-black text-red-500 hover:bg-red-50 rounded-xl transition-all text-left">
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


        {{-- FORMULARIO LATERAL PARA CATEGORÍAS --}}
        <div class="lg:col-span-1 animate-in delay-3 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden sticky top-6">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                <h3 id="cat-form-titulo" class="text-lg font-black text-gray-800 dark:text-white">Nueva Categoría</h3>
                <p id="cat-form-subtitulo" class="text-xs text-gray-500 mt-1">Organiza tu menú por grupos</p>
            </div>

            <form id="form-categoria" action="{{ url('/dashboard/categoryRegistration') }}" method="POST" class="p-6">
                @csrf
                {{-- Contenedor para inyectar el @method('PUT') vía JS --}}
                <div id="cat-metodo-adicional"></div>

                <div class="mb-6">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">
                        Nombre de la Categoría <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="cat_input_name" required placeholder="Ej. Pizzas, Hamburguesas..."
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" id="cat-btn-submit"
                            class="w-full flex justify-center items-center gap-2 px-6 py-3.5 bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm font-black rounded-xl shadow-lg shadow-orange-500/25 hover:scale-[1.02] active:scale-95 transition-all">
                        Guardar Categoría
                    </button>
                    <button type="button" id="cat-btn-cancelar" onclick="window.location.reload()"
                            class="hidden w-full flex justify-center items-center px-6 py-2 text-sm font-bold text-gray-500 hover:text-gray-800 transition-all">
                        Cancelar Edición
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
