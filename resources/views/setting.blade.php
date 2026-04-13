@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="animate-in fade-in duration-500">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-red-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight italic">Configuración del Sistema</h2>
                <p class="text-sm text-gray-500 font-medium">Personaliza la identidad visual de tu empresa.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900 rounded-2xl flex items-center gap-3 animate-in slide-in-from-top-4">
                <div class="bg-emerald-500 rounded-full p-1 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <p class="text-sm font-bold text-emerald-700 dark:text-emerald-400">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-900 rounded-3xl p-6 sm:p-8 shadow-card border border-gray-100 dark:border-gray-800">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                    {{-- Visualización del Logo --}}
                    <div class="flex flex-col items-center">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4 text-center">Logo Actual</label>
                        <div class="w-48 h-48 bg-gray-50 dark:bg-gray-800/50 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700 flex items-center justify-center p-4 relative group overflow-hidden shadow-inner">
                            @if($settings && $settings->company_logo)
                                <img src="{{ $settings->company_logo && file_exists(public_path($settings->company_logo)) ? asset($settings->company_logo) : asset('storage/' . $settings->company_logo) }}" alt="Logo preview" class="max-w-full max-h-full object-contain drop-shadow-lg">
                            @else
                                <div class="text-gray-300 dark:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                </div>
                            @endif
                        </div>
                        <p class="text-[10px] text-gray-400 mt-4 text-center max-w-[200px]">Se recomienda usar PNG transparente de 512x512px.</p>
                    </div>

                    {{-- Formulario de Datos --}}
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2">Nombre de la Empresa</label>
                            <input type="text" name="company_name" value="{{ $settings->company_name ?? 'Paseillo' }}" required
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-800 dark:text-white focus:ring-2 focus:ring-red-500/20 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2">Eslogan o Subtítulo</label>
                            <input type="text" name="company_subtitle" value="{{ $settings->company_subtitle ?? 'Burger & Pizzas' }}"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 focus:ring-2 focus:ring-red-500/20 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2">Subir Nuevo Logo</label>
                            <div class="relative group">
                                <input type="file" name="company_logo" id="logo-input" accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-xl text-sm text-gray-500 dark:text-gray-400 flex items-center justify-between group-hover:border-red-400 transition-all">
                                    <span id="file-name">Selecciona un archivo...</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-50 dark:border-gray-800">
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white text-sm font-black rounded-xl shadow-lg shadow-red-500/25 transition-all active:scale-95 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('logo-input').addEventListener('change', function(e) {
        const name = e.target.files[0] ? e.target.files[0].name : 'Selecciona un archivo...';
        document.getElementById('file-name').textContent = name;
    });
</script>
@endsection
