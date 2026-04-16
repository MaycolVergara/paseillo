@extends('layouts.app')

@section('content')
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-800 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                    <i data-lucide="circle-user-round" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white tracking-tight italic">Clientes
                        Paseillo</h2>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5 uppercase tracking-widest">Gestión de planilla
                        de Clientes</p>
                </div>
            </div>

            <div class="flex flex-1 max-w-md items-center gap-3">
                <div class="relative w-full">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </span>
                    <input type="text" id="searchInput" placeholder="Buscar por nombre o DNI..."
                        class="w-full pl-9 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all outline-none dark:text-white">
                </div>

            </div>
        </div>
    </div>

    <div
        class="animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800">
        <div class="min-w-full inline-block align-middle">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-auto border-spacing-0 min-w-[800px] md:min-w-full">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                            <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400">Trabajador
                            </th>
                            <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400">Apellido
                            </th>
                            <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400 text-center">
                                Numero/Cell
                            </th>
                            <th class="px-6 py-5 text-[11px] font-black uppercase tracking-wider text-gray-400 text-center">
                                Dni
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tabla-paginada" class="divide-y divide-gray-50 dark:divide-gray-800">
                        @foreach ($customer as $staff)
                            <tr class="group hover:bg-orange-50/30 dark:hover:bg-orange-900/5 transition-all fila-paginada">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white texto-buscar">
                                                {{ $staff->name }}</p>

                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400 italic texto-buscar">
                                    {{ $staff->surname }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400 italic texto-buscar">
                                    {{ $staff->phone }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-400 italic texto-buscar">
                                    {{ $staff->dni }}
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="paginacion-contenedor"
            class="px-6 py-4 border-t border-gray-100 dark:border-gray-800 flex justify-center items-center bg-gray-50/30 dark:bg-gray-800/20">
        </div>
    </div>
@endsection
