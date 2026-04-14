@extends('layouts.app')

@section('content')
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Editar Producto</h2>
                <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Actualiza los datos del menú</p>
            </div>
        </div>

            <div class="flex items-center gap-3">
                {{-- Ruta: productos -> productList --}}
                <a href="{{ url('/dashboard/productList') }}"
                   class="flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all active:scale-95">
                    <i data-lucide="chevron-left" class="w-[18px] h-[18px]"></i>
                    Volver al Catálogo
                </a>
            </div>
        </div>
    </div>

    <div
        class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden max-w-4xl mx-auto">

        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-lg font-black text-gray-800 dark:text-white">Información del Producto</h3>
            <p class="text-sm text-gray-500 mt-1">Actualiza los datos requeridos en el sistema.</p>
        </div>
        
        @if ($errors->any())
            <div class="px-8 py-4 bg-red-50 border-b border-red-100">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm font-bold text-red-600 uppercase tracking-tight">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Ruta y variable actualizadas: $producto->id_producto -> $product->id --}}
        <form action="{{ url('/dashboard/products/' . $product->id . '/update') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre del Producto
                        <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="shopping-bag" class="w-[18px] h-[18px]"></i>
                        </div>
                        {{-- nombre_producto -> name --}}
                        <input type="text" name="name" required placeholder="Ej. Pizza Americana Familiar"
                               value="{{$product->name}}"
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border
                                border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Categoría <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        {{-- id_categoria -> category_id --}}
                        <select name="category_id" required
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium appearance-none cursor-pointer">
                            <option value="" disabled>Selecciona una categoría...</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Imagen del Producto</label>

                    {{-- imagen_producto -> product_image --}}
                    @if($product->image)
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-1">Imagen actual:</p>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen actual" class="h-20 w-20 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif

                    <input type="file" name="image" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-red-50 file:text-red-600
                hover:file:bg-red-100 dark:text-gray-400">
                    <p class="text-xs text-gray-500 mt-2">Sube una nueva imagen solo si deseas cambiar la actual.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Precio de Venta <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold sm:text-sm">S/</span>
                        </div>
                        {{-- precio -> price --}}
                        <input type="number" step="0.01" name="price" required placeholder="0.00"
                               value="{{$product->price}}"
                               class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-black text-lg">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Fecha de Entrega
                        (Opcional)</label>
                    {{-- fecha_entrega -> delivery_date --}}
                    <input type="date" name="delivery_date" value="{{$product->delivery_date}}"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white text-gray-600 font-medium cursor-pointer">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Descripción e
                        Ingredientes</label>
                    {{-- descripcion_producto -> description --}}
                    <textarea name="description" rows="4"
                              placeholder="Detalla los ingredientes..."
                              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white resize-none">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ url('/dashboard/productList') }}"
                   class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-800 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition-all">
                    Cancelar
                </a>
                <button type="submit"
                        class="flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm font-black rounded-xl shadow-lg shadow-orange-500/25 hover:scale-[1.02] active:scale-95 transition-all">
                    <i data-lucide="save" class="w-[18px] h-[18px]"></i>
                    Actualizar Producto
                </button>
            </div>

        </form>
    </div>
@endsection
