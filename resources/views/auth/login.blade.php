<!doctype html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="img/logo_principal.png" type="image/png">

    <title>Paseillo — Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet"/>
    @vite(['resources/css/admin/admin.css', 'resources/js/app.js'])
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
                @php
                    $logoPath = optional($settings)->company_logo ?? 'img/logo_principal.png';
                    if (str_starts_with($logoPath, 'img/')) {
                        $finalLogo = asset($logoPath);
                    } elseif (config('filesystems.default') === 's3') {
                        $finalLogo = Storage::disk('s3')->url($logoPath);
                    } else {
                        $finalLogo = asset('storage/' . $logoPath);
                    }
                @endphp
                <img src="{{ $finalLogo }}" alt="{{ optional($settings)->company_name ?? 'Logo' }}" class="w-20 h-20 object-contain">
            </div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">{{ optional($settings)->company_name ?? 'Paseillo System' }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ optional($settings)->company_subtitle ?? 'Ingresa tus credenciales para continuar' }}</p>
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
                            <i data-lucide="eye" id="eye-icon" class="w-[18px] h-[18px]"></i>
                            <i data-lucide="eye-off" id="eye-off-icon" class="w-[18px] h-[18px] hidden"></i>
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
