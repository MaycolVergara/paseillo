@extends('layouts.app')

@section('content')
    {{-- Header Standard --}}
    <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="tag" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Gestión de Categorías
                    </h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Organiza tu menú digital
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ url('/dashboard/productRegistration') }}"
                    class="flex items-center gap-1.5 sm:gap-2 px-6 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:shadow-orange-500/40 shadow-lg transition-all active:scale-95">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    Ir a nuevo producto
                </a>
            </div>
        </div>
    </div>

    {{-- Estructura de Panel --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- TABLA DE CATEGORÍAS --}}
        <div
            class="lg:col-span-2 animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                            <th
                                class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                Nombre
                            </th>
                            <th
                                class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                Vínculo de Stock
                            </th>
                            <th
                                class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 text-right">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tabla-paginada" class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach ($categories as $categorie)
                            <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-all fila-paginada">
                                <td class="px-6 py-5">
                                    <p class="text-[15px] font-extrabold text-gray-900 dark:text-white">
                                        {{ $categorie->name }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    @if ($categorie->stores_id)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400 text-[10px] font-black uppercase tracking-widest border border-blue-100 dark:border-blue-900/40">
                                            {{ $categorie->store->name ?? 'Insumo' }}
                                        </span>
                                    @else
                                        <span class="text-[10px] font-bold text-gray-400 italic">Sin vínculo</span>
                                    @endif
                                </td>

                                <td class="px-6 py-5 text-right relative">
                                    <div class="inline-block text-left group/menu relative">
                                        <button
                                            class="p-2 rounded-xl text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-orange-600 transition-all">
                                            <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                        </button>
                                        <div
                                            class="absolute right-full top-0 mr-2 w-40 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl z-50 invisible group-hover/menu:visible opacity-0 group-hover/menu:opacity-100 transition-all duration-300 transform origin-right scale-95 group-hover/menu:scale-100">
                                            <div class="p-1.5 space-y-1">
                                                {{-- Función JS para cargar datos en el form lateral --}}
                                                <button type="button"
                                                    onclick="prepararEdicionCategoria('{{ $categorie->id }}', '{{ $categorie->name }}', '{{ $categorie->stores_id }}')"
                                                    class="flex items-center gap-2 w-full px-3 py-2.5 text-xs font-black text-gray-700 dark:text-gray-300 hover:bg-orange-50 hover:text-orange-600 rounded-xl transition-all text-left">
                                                    Editar
                                                </button>

                                                <form
                                                    action="{{ url('/dashboard/categoryRegistration/' . $categorie->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Eliminar categoría? Esto afectará a sus productos.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="flex items-center gap-2 w-full px-3 py-2.5 text-xs font-black text-red-500 hover:bg-red-50 rounded-xl transition-all text-left">
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
        <div
            class="lg:col-span-1 animate-in delay-3 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden sticky top-6">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                <h3 id="cat-form-titulo" class="text-lg font-black text-gray-800 dark:text-white">Nueva Categoría</h3>
                <p id="cat-form-subtitulo" class="text-xs text-gray-500 mt-1">Organiza tu menú por grupos</p>
            </div>

            <form id="form-categoria" action="{{ url('/dashboard/categoryRegistration') }}" method="POST"
                class="p-4 sm:p-6">
                @csrf
                {{-- Contenedor para inyectar el @method('PUT') vía JS --}}
                <div id="cat-metodo-adicional"></div>

                <div class="space-y-6">
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">
                            Nombre de la Categoría <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="cat_input_name" required
                            placeholder="Ej. Pizzas, Hamburguesas..."
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">
                            Vincular a Stock (Opcional)
                        </label>
                        <select name="stores_id" id="cat_input_stores_id"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium cursor-pointer">
                            <option value="">No vincular a stock</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-gray-400 mt-2 leading-relaxed italic">
                            Si vinculas, todos los productos de esta categoría descontarán de este insumo automáticamente.
                        </p>
                    </div>
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

    <script>
        function prepararEdicionCategoria(id, name, stores_id) {
            document.getElementById('cat-form-titulo').innerText = 'Editar Categoría';
            document.getElementById('cat-form-subtitulo').innerText = 'Actualiza el vínculo de stock';

            const form = document.getElementById('form-categoria');
            form.action = "{{ url('/dashboard/categoryRegistration') }}/" + id + "/update";

            document.getElementById('cat-metodo-adicional').innerHTML = '@method('PUT')';
            document.getElementById('cat_input_name').value = name;

            // Set dynamic select value
            const select = document.getElementById('cat_input_stores_id');
            select.value = stores_id || '';

            document.getElementById('cat-btn-submit').innerText = 'Actualizar Categoría';
            document.getElementById('cat-btn-cancelar').classList.remove('hidden');
        }
    </script>
@endsection
