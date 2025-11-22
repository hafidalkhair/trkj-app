<nav x-data="{
        scrolled: false,
        mobileMenu: false,
        isHome: {{ request()->routeIs('home') ? 'true' : 'false' }}
     }"
     @scroll.window="scrolled = (window.pageYOffset > 50)"
     :class="{
        'top-4 w-[90%] md:w-[85%] lg:w-[1200px] left-1/2 -translate-x-1/2 rounded-2xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-2xl border border-white/40 dark:border-slate-700/50': scrolled,
        'top-0 w-full left-0 bg-transparent border-b border-transparent': !scrolled
     }"
     class="fixed z-50 transition-all duration-700 cubic-bezier(0.4, 0, 0.2, 1)">

    <div class="flex flex-wrap items-center justify-between mx-auto transition-all duration-500 ease-in-out"
         :class="{ 'px-6 py-3': scrolled, 'px-6 py-6 max-w-screen-xl': !scrolled }">

        <!-- Logo Section -->
        <a href="{{ route('home') }}" class="flex items-center group gap-3">
            <!-- Logo Box -->
            <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-xl transition-all duration-500 shadow-lg transform group-hover:rotate-12"
                 :class="{
                    'bg-teal-600 text-white scale-90': scrolled,
                    'bg-teal-600 text-white': !scrolled && !isHome,
                    'bg-white text-teal-600': !scrolled && isHome
                 }">
                C
            </div>

            <!-- Logo Text -->
            <div class="flex flex-col transition-opacity duration-300">
                <span class="text-xl font-bold tracking-wide transition-colors duration-300 leading-none"
                      :class="{
                        'text-slate-900 dark:text-white': scrolled || !isHome,
                        'text-white': !scrolled && isHome
                      }">
                    Copium<span :class="{ 'text-teal-600': scrolled || !isHome, 'text-teal-300': !scrolled && isHome }">.</span>
                </span>
                <!-- Subtext hilang saat scroll agar header lebih ramping -->
                <span class="text-[10px] font-medium uppercase tracking-[0.2em] transition-all duration-300 origin-left"
                      :class="{
                        'opacity-0 h-0 -translate-y-2': scrolled,
                        'opacity-100 h-auto translate-y-0': !scrolled,
                        'text-slate-500 dark:text-slate-400': !scrolled && !isHome,
                        'text-white/70': !scrolled && isHome
                      }">
                    Portfolio
                </span>
            </div>
        </a>

        <!-- Mobile Menu Button (Hamburger) -->
        <button @click="mobileMenu = !mobileMenu" type="button"
                class="inline-flex items-center justify-center p-2 w-10 h-10 text-sm rounded-xl md:hidden focus:outline-none focus:ring-2 transition-all duration-300 hover:scale-105 active:scale-95"
                :class="{
                    'text-slate-600 bg-slate-100 hover:bg-slate-200': scrolled || !isHome,
                    'text-white bg-white/10 hover:bg-white/20 backdrop-blur-md': !scrolled && isHome
                }">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        <!-- Desktop Menu -->
        <div class="hidden w-full md:block md:w-auto">
            <ul class="flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 md:mt-0 md:border-0 font-medium tracking-wide">
                @foreach([
                    ['route' => 'home', 'label' => 'Home'],
                    ['route' => 'gallery', 'label' => 'Gallery'],
                    ['route' => 'structure', 'label' => 'Structure'],
                    ['route' => 'contact', 'label' => 'Contact']
                ] as $item)
                <li>
                    <a href="{{ route($item['route']) }}"
                       class="relative block py-2 px-1 transition-all duration-300 group text-sm uppercase font-bold tracking-wider hover:-translate-y-0.5"
                       :class="{
                            'text-slate-600 hover:text-teal-600 dark:text-slate-300 dark:hover:text-teal-400': scrolled || !isHome,
                            'text-white/80 hover:text-white': !scrolled && isHome
                       }">
                        {{ $item['label'] }}

                        <!-- Dot Indicator Animation -->
                        <span class="absolute left-1/2 -translate-x-1/2 -bottom-1 w-1 h-1 rounded-full transition-all duration-300 opacity-0 group-hover:opacity-100"
                              :class="{
                                'bg-teal-600 w-1.5 h-1.5 opacity-100': {{ request()->routeIs($item['route']) ? 'true' : 'false' }},
                                'bg-teal-600': scrolled || !isHome,
                                'bg-white': !scrolled && isHome
                              }"></span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Mobile Menu Dropdown (Floating Style with Scale Animation) -->
    <div x-show="mobileMenu"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 -translate-y-4"
         @click.away="mobileMenu = false"
         class="md:hidden absolute top-full left-0 w-full mt-4 px-4">

        <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/20 dark:border-slate-700 overflow-hidden">
            <ul class="flex flex-col p-2 font-medium space-y-1">
                @foreach([
                    ['route' => 'home', 'label' => 'Home'],
                    ['route' => 'gallery', 'label' => 'Gallery'],
                    ['route' => 'structure', 'label' => 'Structure'],
                    ['route' => 'contact', 'label' => 'Contact']
                ] as $item)
                <li>
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center justify-between px-6 py-4 rounded-2xl text-sm font-bold uppercase tracking-wider transition-all duration-200 active:scale-95 group {{ request()->routeIs($item['route']) ? 'bg-teal-50 text-teal-700 dark:bg-teal-900/30 dark:text-teal-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                        {{ $item['label'] }}

                        @if(request()->routeIs($item['route']))
                            <span class="w-2 h-2 rounded-full bg-teal-500 shadow-[0_0_10px_rgba(20,184,166,0.5)]"></span>
                        @else
                            <svg class="w-4 h-4 text-slate-300 opacity-0 group-hover:opacity-100 transition-all transform -translate-x-2 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
