@extends('layouts.app')

@section('content')
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-orange-100 to-orange-200 dark:from-orange-900/40 dark:to-orange-900/20 rounded-2xl flex items-center justify-center text-orange-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/>
                        <path d="M12 22V12"/>
                        <path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight italic">Panel de
                        Categorías</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span
                            class="flex items-center gap-1 text-xs font-bold px-2 py-0.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Sistema Activo
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gestiona los grupos del menú de
                            Paseillo.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-1 max-w-md items-center gap-3">
                <div class="relative w-full">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Buscar pizza, burger..."
                           class="w-full pl-9 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all outline-none dark:text-white">
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ url('/dashboard/productosListado') }}"
                       class="flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                        Volver al Registro de Productos
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <div
            class="lg:col-span-2 animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-8 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                            Nombre de la Categoría
                        </th>
                        <th class="px-8 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 text-right">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tabla-paginada" class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($categorias as $categoria)
                        <tr class="group hover:bg-gray-50/50 transition-all fila-paginada">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">

                                <p class="text-xl font-extrabold text-gray-900 dark:text-white tracking-tight texto-buscar">
                                    {{ $categoria->nombre_categoria }}</p></div>
                            </td>
                            <td class="px-8 py-6 text-right relative">
                                <div class="inline-block text-left group/menu relative">
                                    <button
                                        class="p-3 rounded-2xl text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-orange-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="1"/>
                                            <circle cx="12" cy="5" r="1"/>
                                            <circle cx="12" cy="19" r="1"/>
                                        </svg>
                                    </button>
                                    <div
                                        class="absolute right-full top-0 mr-3 w-48 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-2xl z-50 invisible group-hover/menu:visible opacity-0 group-hover/menu:opacity-100 transition-all duration-300 transform origin-right scale-95 group-hover/menu:scale-100">
                                        <div class="p-2 space-y-1">
                                            <button type="button"
                                                    onclick="prepararEdicion('{{ $categoria->id_categoria }}', '{{ $categoria->nombre_categoria }}')"
                                                    class="flex items-center gap-3 w-full px-4 py-3 text-sm font-black text-gray-700 dark:text-gray-300 hover:bg-orange-50 hover:text-orange-600 rounded-2xl transition-all">
                                                Editar
                                            </button>
                                            <form action="{{ url('/dashboard/categoriasRegistro/'.$categoria->id_categoria) }}"
                                                  method="POST" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="flex items-center gap-3 w-full px-4 py-3 text-sm font-black text-red-500 hover:bg-red-50 rounded-2xl transition-all text-left">
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
            <div id="paginacion-contenedor"
                 class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 flex justify-center items-center gap-1.5"></div>
        </div>

        <div
            class="lg:col-span-1 animate-in delay-3 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden sticky top-6">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                <h3 id="form-titulo" class="text-lg font-black text-gray-800 dark:text-white">Nueva Categoría</h3>
                <p id="form-subtitulo" class="text-xs text-gray-500 mt-1">Añade un nuevo grupo al catálogo.</p>
            </div>

            <form id="form-categoria" action="{{ url('/dashboard/categoriasRegistro') }}" method="POST" class="p-6">
                @csrf
                <div id="metodo-adicional"></div>
                <div class="mb-5">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre de la Categoría
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="nombre_categoria" id="input_nombre" required
                           placeholder="Ej. Pizzas Familiares"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" id="btn-submit"
                            class="w-full flex justify-center items-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm font-black rounded-xl shadow-lg shadow-orange-500/25 hover:scale-[1.02] active:scale-95 transition-all">
                        Guardar Categoría
                    </button>
                    <button type="button" id="btn-cancelar" onclick="window.location.reload()"
                            class="hidden w-full flex justify-center items-center px-6 py-2 text-sm font-bold text-gray-500 hover:text-gray-800 transition-all">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
