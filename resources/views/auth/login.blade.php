<!doctype html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Paseillo — Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="bg-gray-50 dark:bg-gray-950 text-gray-800 dark:text-gray-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md animate-in fade-in zoom-in duration-500">
    {{-- Tarjeta de Login --}}
    <div
        class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">

        {{-- Cabecera con Logo --}}
        <div class="px-8 pt-10 pb-6 text-center">
            <div
                class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 ">
                <img src="{{ $settings->company_logo && file_exists(public_path($settings->company_logo)) ? asset($settings->company_logo) : asset('storage/' . ($settings->company_logo ?? 'img/logo_principal.png')) }}" alt="{{ $settings->company_name ?? 'Logo' }}" class="w-20 h-20 object-contain">
            </div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">{{ $settings->company_name ?? 'Paseillo System' }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $settings->company_subtitle ?? 'Ingresa tus credenciales para continuar' }}</p>
        </div>

        {{-- Formulario --}}
        <div class="px-8 pb-10">
            {{-- Mantenemos la ruta login.post que definimos en web.php --}}
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Mensaje de Error --}}
                @if ($errors->any())
                    <div
                        class="p-3 rounded-xl bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-900 text-red-600 dark:text-red-400 text-sm font-bold text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 dark:text-gray-300 mb-1.5">Usuario</label>
                    <input type="text" name="username" required placeholder="admin"
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all dark:text-white">
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 dark:text-gray-300 mb-1.5">Contraseña</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required placeholder="••••••••"
                               class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition-all dark:text-white pr-10">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg id="eye-off-icon" class="hidden" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                        class="w-full flex justify-center items-center gap-2 px-6 py-3.5 mt-2 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white text-sm font-black rounded-xl shadow-lg shadow-red-500/25 hover:scale-[1.02] active:scale-95 transition-all">
                    Ingresar al Sistema
                </button>
            </form>
        </div>

        <script>
            function togglePasswordVisibility() {
                const passwordInput = document.getElementById('password');
                const eyeIcon = document.getElementById('eye-icon');
                const eyeOffIcon = document.getElementById('eye-off-icon');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeOffIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeOffIcon.classList.add('hidden');
                    eyeIcon.classList.remove('hidden');
                }
            }
        </script>
    </div>
</div>

</body>
</html>
