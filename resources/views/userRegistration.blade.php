@extends('layouts.app')

@section('content')
    {{-- CABECERA --}}
    <div
        class="animate-in delay-1 bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-card border border-gray-100/80 dark:border-gray-800 relative overflow-hidden group mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-orange-100 to-orange-200 dark:from-orange-900/40 dark:to-orange-900/20 rounded-2xl flex items-center justify-center text-orange-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight italic">Gestión de
                        Usuarios</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span
                            class="flex items-center gap-1 text-xs font-bold px-2 py-0.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Sistema Activo
                        </span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Administra los accesos de tu personal.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-1 max-w-md items-center gap-3">
                <div class="relative w-full">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle
                                cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Buscar usuario..."
                           class="w-full pl-9 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all outline-none dark:text-white">
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ url('/dashboard') }}"
                       class="flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                        Volver al Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENIDO PRINCIPAL --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- TABLA DE USUARIOS --}}
        <div
            class="lg:col-span-2 animate-in delay-2 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                            Nombre
                        </th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                            Correo
                        </th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                            Usuario
                        </th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                            Rol
                        </th>
                        <th class="px-6 py-5 text-sm font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 text-right">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tabla-paginada" class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($users as $user)
                        <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-all fila-paginada">
                            <td class="px-6 py-5">

                                <p class="text-[15px] font-extrabold text-gray-900 dark:text-white">{{ $user->name }}</p>
                            </td>
                            <td class="px-6 py-5">

                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                            </td>
                            <td class="px-6 py-5">
                                    <span
                                        class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 px-3 py-1.5 rounded-lg text-sm font-bold">

                                        {{ $user->username }}
                                    </span>
                            </td>
                            <td class="px-6 py-5">
                                @php
                                    $esAdmin = $user->role_id == 1;
                                      $colorRol = $esAdmin ? 'bg-red-100 text-red-700 dark:bg-red-900/30
                                       dark:text-red-400' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400';
                                @endphp
                                <span
                                    class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider {{ $colorRol }}">
                                        {{-- rolAsignado -> assignedRole --}}
                                    {{ $user->assignedRole ? $user->assignedRole->name : 'Sin rol' }}
                                    </span>
                            </td>
                            <td class="px-6 py-5 text-right relative">
                                <div class="inline-block text-left group/menu relative">
                                    <button
                                        class="p-2 rounded-xl text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-orange-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="1"/>
                                            <circle cx="12" cy="5" r="1"/>
                                            <circle cx="12" cy="19" r="1"/>
                                        </svg>
                                    </button>
                                    <div
                                        class="absolute right-full top-0 mr-2 w-40 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl z-50 invisible group-hover/menu:visible opacity-0 group-hover/menu:opacity-100 transition-all duration-300 transform origin-right scale-95 group-hover/menu:scale-100">
                                        <div class="p-1.5 space-y-1">
                                            {{-- ID -> id --}}
                                            <button type="button"
                                                    onclick="editarUsuario('{{ $user->id }}',
                                                    '{{ $user->name }}', '{{ $user->email }}',
                                                    '{{ $user->username }}', '{{ $user->role_id }}')"
                                                    class="flex items-center gap-2 w-full px-3 py-2.5 text-xs font-black text-gray-700 dark:text-gray-300 hover:bg-orange-50 hover:text-orange-600 rounded-xl transition-all">
                                                Editar
                                            </button>
                                            {{-- usuariosRegistro -> userRegistration --}}
                                            <form
                                                action="{{ url('/dashboard/userRegistration/'.$user->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
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
        </div>

        {{-- FORMULARIO LATERAL --}}
        <div
            class="lg:col-span-1 animate-in delay-3 bg-white dark:bg-gray-900 rounded-3xl shadow-card border border-gray-100/80 dark:border-gray-800 overflow-hidden sticky top-6">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                <h3 id="form-titulo" class="text-lg font-black text-gray-800 dark:text-white">Nuevo Usuario</h3>
                <p id="form-subtitulo" class="text-xs text-gray-500 mt-1">Registra personal en el sistema</p>
            </div>

            <form id="form-usuario" action="{{ url('/dashboard/userRegistration') }}" method="POST" class="p-6">
                @csrf
                <div id="metodo-adicional"></div>

                <div class="mb-4">
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Nombre
                        Completo <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required placeholder="Ej. Maycol Vergara"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                </div>

                <div class="mb-4">
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Correo
                        Electrónico <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required placeholder="correo@ejemplo.com"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                </div>

                <div class="mb-4">
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Usuario
                        (Login) <span class="text-red-500">*</span></label>
                    <input type="text" name="username" required placeholder="Ej. maycol123"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                </div>

                <div class="mb-4">
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Contraseña
                        <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required placeholder="Introduzca la contraseña"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-medium">
                </div>


                <div class="mb-6 relative">
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">
                        Rol en el Sistema <span class="text-red-500">*</span></label>
                    {{-- name="role_id" --}}
                    <select name="role_id" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition-all dark:text-white font-bold cursor-pointer appearance-none">
                        <option value="" disabled selected>Selecciona un rol...</option>
                        {{-- $rols -> $roles --}}
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 top-6 flex items-center px-4 text-gray-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit" id="btn-submit"
                            class="w-full flex justify-center items-center gap-2 px-6 py-3.5 bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm font-black rounded-xl shadow-lg shadow-orange-500/25 hover:scale-[1.02] active:scale-95 transition-all">
                        Guardar Usuario
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
