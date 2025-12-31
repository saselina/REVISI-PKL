<nav x-data="{ open:false, welcomeOpen: {{ session('show_welcome') ? 'true' : 'false' }} }"
     class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT: LOGO --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">

                </a>

                <div class="hidden sm:flex sm:ml-6">

                </div>
            </div>

            {{-- RIGHT AREA --}}
            <div class="hidden sm:flex items-center">

                {{-- ========================================= --}}
                {{--            POPUP WELCOME LOGIN             --}}
                {{-- ========================================= --}}
                <div
                    x-show="welcomeOpen"
                    x-transition
                    x-cloak
                    class="absolute top-20 right-5 w-96 bg-white shadow-xl rounded-xl p-4 border border-gray-100 z-[99999]"
                >
                    <div class="flex items-start">
                        <div class="w-10 h-10 flex items-center justify-center bg-[#647FBC] text-white rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5.121 17.804A9 9 0 1118.364 4.561 9 9 0 015.121 17.804z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <div class="flex-1">
                            <h2 class="text-lg font-semibold text-[#647FBC]">
                                Hi! {{ auth()->user()->name }}
                            </h2>
                            <p class="text-sm text-gray-600">
                                Selamat Datang di Sistem Informasi Aset Perusahaan.
                            </p>
                        </div>

                        <button class="text-gray-400 hover:text-gray-600"
                                @click="welcomeOpen = false">
                            ✕
                        </button>
                    </div>
                </div>
                {{-- ========= END POPUP ========= --}}

                {{-- DROPDOWN PROFILE --}}
                <div class="relative" x-data="{ openMenu:false }">

                    <button @click="openMenu=!openMenu"
                        class="flex items-center p-2 rounded-full hover:bg-gray-100 transition">

                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=CBDCEB&color=647FBC"
                            class="w-8 h-8 rounded-full shadow-sm" alt="{{ auth()->user()->name }}" />

                        <span class="ml-2 text-sm font-medium text-gray-700 hidden lg:inline">
                            {{ auth()->user()->name }}
                        </span>

                        <svg class="ml-1 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'rotate-180': openMenu}" class="transition-transform"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div
                        x-show="openMenu"
                        @click.away="openMenu=false"
                        x-cloak
                        class="absolute right-0 mt-3 w-60 bg-white rounded-lg shadow-xl border border-gray-100 z-[9999]"
                    >
                        <div class="p-3 border-b bg-[#CBDCEB] rounded-t-lg">
                            <p class="text-base font-semibold text-gray-800">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>

                        <div class="flex flex-col p-1">

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center space-x-2 px-3 py-2 text-gray-700 rounded-md hover:bg-[#CBDCEB]">
                                <svg class="w-5 h-5 text-[#647FBC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 7a2 2 0 012 2v5a2 2 0 01-2 2H9a2 2 0 01-2-2V9a2 2 0 012-2h6zm-2 5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Ubah Password</span>
                            </a>

                            <button
                                wire:click="logout"
                                class="flex items-center space-x-2 px-3 py-2 text-gray-700 rounded-md hover:bg-red-100 hover:text-red-700 w-full text-left"
                            >
                                <svg class="w-5 h-5 text-[#647FBC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Logout</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

            {{-- HAMBURGER --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open=!open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#647FBC] hover:bg-[#CBDCEB]">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open}" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open}" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
</nav>
