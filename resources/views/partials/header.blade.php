<nav x-data="{
        scrolled: false,
        mobileMenu: false,
        isHome: {{ request()->routeIs('home') ? 'true' : 'false' }}
     }"
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="{ 'bg-white/90 dark:bg-slate-900/90 backdrop-blur-md shadow-lg py-3': scrolled, 'bg-transparent py-6': !scrolled }"
     class="fixed w-full z-50 top-0 left-0 transition-all duration-300">

    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center group">
            <!-- Logic Logo Box:
                 - Home & Top: Putih (biar kontras dengan bg gelap)
                 - Halaman Lain / Scrolled: Teal (warna brand) -->
            <div class="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-xl mr-3 transition-all duration-300 shadow-lg"
                 :class="{
                    'bg-teal-600 text-white': scrolled || !isHome,
                    'bg-white text-teal-600': !scrolled && isHome
                 }">
                C
            </div>

            <!-- Logic Logo Text:
                 - Home & Top: Putih
                 - Halaman Lain / Scrolled: Hitam (Slate-900) -->
            <span class="self-center text-2xl font-bold whitespace-nowrap tracking-wide transition-colors duration-300"
                  :class="{
                    'text-slate-900 dark:text-white': scrolled || !isHome,
                    'text-white': !scrolled && isHome
                  }">
                Copium<span :class="{ 'text-teal-600': scrolled || !isHome, 'text-teal-300': !scrolled && isHome }">.</span>
            </span>
        </a>

        <!-- Mobile Menu Button -->
        <button @click="mobileMenu = !mobileMenu" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 transition-colors"
                :class="{
                    'text-slate-500 hover:bg-slate-100': scrolled || !isHome,
                    'text-white hover:bg-white/10': !scrolled && isHome
                }">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        <!-- Desktop Menu -->
        <div class="hidden w-full md:block md:w-auto">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 md:mt-0 md:border-0 tracking-wide">
                @foreach([
                    ['route' => 'home', 'label' => 'Home'],
                    ['route' => 'gallery', 'label' => 'Gallery'],
                    ['route' => 'structure', 'label' => 'Structure'],
                    ['route' => 'contact', 'label' => 'Contact']
                ] as $item)
                <li>
                    <a href="{{ route($item['route']) }}"
                       class="relative block py-2 pl-3 pr-4 transition-colors duration-300 group font-medium"
                       :class="{
                            'text-slate-700 dark:text-slate-300 hover:text-teal-600': scrolled || !isHome,
                            'text-white/90 hover:text-white': !scrolled && isHome
                       }">
                        {{ $item['label'] }}

                        <!-- Underline Animation -->
                        <span class="absolute inset-x-0 bottom-0 h-0.5 transform scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"
                              :class="{
                                'bg-teal-600': scrolled || !isHome,
                                'bg-white': !scrolled && isHome,
                                'scale-x-100': {{ request()->routeIs($item['route']) ? 'true' : 'false' }}
                              }"></span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div x-show="mobileMenu"
         x-collapse
         class="md:hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 shadow-xl max-h-screen overflow-y-auto">
        <ul class="flex flex-col p-4 font-medium space-y-2">
            @foreach([
                ['route' => 'home', 'label' => 'Home'],
                ['route' => 'gallery', 'label' => 'Gallery'],
                ['route' => 'structure', 'label' => 'Structure'],
                ['route' => 'contact', 'label' => 'Contact']
            ] as $item)
            <li>
                <a href="{{ route($item['route']) }}"
                   class="block py-4 px-4 rounded-xl text-lg font-semibold {{ request()->routeIs($item['route']) ? 'bg-teal-50 text-teal-600 dark:bg-teal-900/30 dark:text-teal-400' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">
                    {{ $item['label'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>
