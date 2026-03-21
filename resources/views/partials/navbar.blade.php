<header
    class="sticky top-0 z-20 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 shadow-sm">
    <div class="flex items-center h-[62px] px-6 gap-4">
        <div class="flex items-center gap-3">
            {{-- Mantenemos el JS original: toggleSidebar() --}}
            <button onclick="toggleSidebar()" title="Colapsar menú"
                    class="flex items-center justify-center w-8 h-8 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-500 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     class="w-[18px] h-[18px]">
                    <path fill-rule="evenodd"
                          d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
            <div class="flex items-center gap-2.5">
                <div class="w-1 h-5 rounded-full bg-gradient-to-b from-red-500 to-orange-400"></div>
                <h1 class="font-bold text-[15px] text-gray-800 dark:text-gray-100 tracking-tight">Panel Principal</h1>
            </div>
        </div>

        <div class="flex-1"></div>

        {{-- Mantenemos el JS original: toggleTheme() --}}
        <div
            class="flex items-center gap-1 bg-gray-100 dark:bg-gray-800 rounded-lg px-2 py-1.5 cursor-pointer select-none"
            onclick="toggleTheme()" title="Cambiar tema">
            <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="w-3.5 h-3.5 text-orange-500">
                <path
                    d="M10 2a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 2zM10 15a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 15zM10 7a3 3 0 100 6 3 3 0 000-6zM15.657 5.404a.75.75 0 10-1.06-1.06l-1.061 1.06a.75.75 0 001.06 1.06l1.06-1.06zM6.464 14.596a.75.75 0 10-1.06-1.06l-1.06 1.06a.75.75 0 001.06 1.06l1.06-1.06zM18 10a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 0118 10zM5 10a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 015 10zM14.596 15.657a.75.75 0 001.06-1.06l-1.06-1.061a.75.75 0 10-1.06 1.06l1.06 1.06zM5.404 6.464a.75.75 0 001.06-1.06l-1.06-1.06a.75.75 0 10-1.061 1.06l1.06 1.06z"/>
            </svg>
            <div class="toggle-track mx-0.5">
                <div class="toggle-thumb"></div>
            </div>
            <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="w-3.5 h-3.5 text-gray-400 dark:text-blue-400">
                <path fill-rule="evenodd"
                      d="M7.455 2.004a.75.75 0 01.26.77 7 7 0 009.958 7.967.75.75 0 011.067.853A8.5 8.5 0 116.647 1.921a.75.75 0 01.808.083z"
                      clip-rule="evenodd"/>
            </svg>
        </div>

        <div class="w-px h-6 bg-gray-200 dark:bg-gray-700"></div>

        <div class="text-right select-none">
            <p id="clock-time"
               class="font-bold text-[14px] text-gray-800 dark:text-gray-100 tabular-nums leading-none tracking-tight"></p>
            <p id="clock-date" class="text-[10px] text-gray-400 dark:text-gray-500 font-medium mt-0.5 leading-none"></p>
        </div>

        <div class="w-px h-6 bg-gray-200 dark:bg-gray-700"></div>

        <div class="relative" id="profile-wrap">
            <button
                class="flex items-center gap-2.5 px-2.5 py-1.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200 cursor-pointer select-none"
                onclick="toggleDropdown()">
                {{-- rol -> role_id --}}
                @if(Auth::user()->role_id == 1)
                    🤵‍
                @else
                    🧑‍🍳
                @endif

                <div class="text-left">
                    <p class="text-[13px] font-semibold text-gray-800 dark:text-gray-100 leading-none">
                        {{-- rol -> role_id y nombre -> name --}}
                        @if(Auth::user()->role_id == 1)
                            {{ Auth::user()->name }}
                        @else
                            Mozo
                        @endif</p>
                    <p class="text-[10px] text-gray-400 mt-1 leading-none">
                        @if(Auth::user()->role_id == 1)
                            Administrador
                        @else
                            Mozo
                        @endif
                    </p>
                </div>
                <svg class="w-3.5 h-3.5 text-gray-400 ml-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.04 1.08l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd"/>
                </svg>
            </button>

            <div id="profile-dropdown"
                 class="dropdown-menu absolute top-[calc(100%+10px)] right-0 w-56 bg-white dark:bg-gray-900 rounded-2xl shadow-dropdown border border-gray-100 dark:border-gray-800 overflow-hidden z-50">
                <div
                    class="px-4 py-3.5 border-b border-gray-100 dark:border-gray-800 bg-gradient-to-br from-red-50 to-orange-50 dark:from-red-950/20 dark:to-orange-950/20">
                    {{-- rol -> role_id, nombre -> name, correo -> email --}}
                    @if(Auth::user()->role_id == 1)
                        <p class="text-[13px] font-bold text-gray-800 dark:text-gray-100">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">{{ Auth::user()->email }}</p>
                    @endif
                </div>
                <div class="py-1.5">
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-2.5 text-[13px] font-medium text-gray-600 dark:text-gray-400 hover:bg-orange-50 dark:hover:bg-orange-950/20 hover:text-orange-600 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-4 h-4 shrink-0">
                            <path fill-rule="evenodd"
                                  d="M7.84 1.804A1 1 0 018.82 1h2.36a1 1 0 01.98.804l.331 1.652a6.993 6.993 0 011.929 1.115l1.598-.54a1 1 0 011.186.447l1.18 2.044a1 1 0 01-.205 1.251l-1.267 1.113a7.047 7.047 0 010 2.228l1.267 1.113a1 1 0 01.206 1.25l-1.18 2.045a1 1 0 01-1.187.447l-1.598-.54a6.993 6.993 0 01-1.929 1.115l-.33 1.652a1 1 0 01-.98.804H8.82a1 1 0 01-.98-.804l-.331-1.652a6.993 6.993 0 01-1.929-1.115l-1.598.54a1 1 0 01-1.186-.447l-1.18-2.044a1 1 0 01.205-1.251l-1.267-1.114a7.05 7.05 0 010-2.227L1.821 7.773a1 1 0 01-.206-1.25l1.18-2.045a1 1 0 011.187-.447l1.598.54A6.993 6.993 0 017.51 3.456l.33-1.652zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                  clip-rule="evenodd"/>
                        </svg>
                        Configuración
                    </a>
                    <div class="mx-3 my-1 h-px bg-gray-100 dark:bg-gray-800"></div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-[13px] font-medium text-red-500 hover:bg-red-50 dark:hover:bg-red-950/20 transition-colors duration-150 text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 shrink-0">
                                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M19 10a.75.75 0 00-.75-.75H8.704l1.048-1.04a.75.75 0 10-1.004-1.116l-2.5 2.25a.75.75 0 000 1.112l2.5 2.25a.75.75 0 101.004-1.116l-1.048-1.04h9.546A.75.75 0 0019 10z" clip-rule="evenodd"/>
                            </svg>
                            Salir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
