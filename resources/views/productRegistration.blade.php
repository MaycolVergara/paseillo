@extends('layouts.app')

@section('content')
    {{-- Header de la página --}}
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-4 sm:p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="package" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Registrar Producto
                    </h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Añade una nueva pizza o
                        burger</p>
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ url('/dashboard/productList') }}"
                    class="flex items-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-2.5 sm:py-3 rounded-xl text-[12px] sm:text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all active:scale-95">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    Volver
                </a>
                <a href="{{ url('/dashboard/categoryRegistration') }}"
                    class="flex items-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-2.5 sm:py-3 rounded-xl text-[12px] sm:text-sm font-bold text-white bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 shadow-lg shadow-orange-500/25 transition-all transform hover:scale-[1.03] active:scale-95">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Ir a nueva categoría
                </a>
            </div>
        </div>
    </div>

    {{-- Card del Formulario --}}
    <div
        class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden max-w-4xl mx-auto">
        <div class="px-4 sm:px-8 py-6 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-lg font-black text-gray-800 dark:text-white">Información del Nuevo Producto</h3>
            <p class="text-sm text-gray-500 mt-1">Completa los datos requeridos para registrar el plato en el sistema.</p>
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

        <form action="{{ url('/dashboard/productRegistration') }}" method="POST" enctype="multipart/form-data"
            class="p-4 sm:p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nombre --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre del Producto <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="shopping-bag" class="w-[18px] h-[18px]"></i>
                        </div>
                        <input type="text" name="name" required placeholder="Ej. Pizza Americana Familiar"
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                    </div>
                </div>

                {{-- Categoría --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Categoría <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="category_id" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium appearance-none cursor-pointer">
                            <option value="" disabled selected>Selecciona una categoría...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>

                {{-- Precio --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Precio de Venta <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 font-bold">
                            S/</div>
                        <input type="number" step="0.01" name="price" required placeholder="0.00"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-black text-lg">
                    </div>
                </div>

                {{-- Fecha --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Fecha de Entrega
                        (Opcional)</label>
                    <input type="date" name="delivery_date"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium cursor-pointer">
                </div>



                {{-- Descripción --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Descripción e
                        Ingredientes</label>
                    <textarea name="description" rows="4" placeholder="Detalla los ingredientes..."
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white resize-none"></textarea>
                </div>
            </div>

            {{-- Botones de acción --}}
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ url('/dashboard/productList') }}"
                    class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-800 dark:hover:text-white transition-all">
                    Cancelar
                </a>
                <button type="submit"
                    class="flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-black text-white bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 shadow-lg shadow-orange-500/25 transition-all transform hover:scale-[1.02] active:scale-95">
                    <i data-lucide="save" class="w-[18px] h-[18px]"></i>
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>
@endsection
