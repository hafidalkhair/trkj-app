<nav class="bg-teal-50/80 dark:bg-teal-950/80 backdrop-blur-sm fixed w-full z-50 top-0 left-0 border-b border-teal-200/50 dark:border-teal-800">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center">
            <span
                class="self-center text-2xl font-playfair font-semibold whitespace-nowrap text-teal-900 dark:text-teal-100">COPIUM</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-teal-700 dark:text-teal-300 rounded-lg md:hidden hover:bg-teal-100 dark:hover:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-300 dark:focus:ring-teal-700"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-teal-200/50 dark:border-teal-800 rounded-lg bg-teal-50/90 dark:bg-teal-950/90 backdrop-blur-sm md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent dark:md:bg-transparent">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 pl-3 pr-4 text-teal-800 dark:text-teal-200 rounded hover:bg-teal-100 dark:hover:bg-teal-900 md:hover:bg-transparent md:border-0 md:hover:text-teal-600 dark:md:hover:text-teal-300 md:p-0 {{ request()->routeIs('home') ? 'md:text-teal-600 dark:md:text-teal-300' : '' }} transition-colors">Home</a>
                </li>
                <li>
                    <a href="{{ route('gallery') }}"
                        class="block py-2 pl-3 pr-4 text-teal-800 dark:text-teal-200 rounded hover:bg-teal-100 dark:hover:bg-teal-900 md:hover:bg-transparent md:border-0 md:hover:text-teal-600 dark:md:hover:text-teal-300 md:p-0 {{ request()->routeIs('gallery') ? 'md:text-teal-600 dark:md:text-teal-300' : '' }} transition-colors">Gallery</a>
                </li>
                <li>
                    <a href="{{ route('structure') }}"
                        class="block py-2 pl-3 pr-4 text-teal-800 dark:text-teal-200 rounded hover:bg-teal-100 dark:hover:bg-teal-900 md:hover:bg-transparent md:border-0 md:hover:text-teal-600 dark:md:hover:text-teal-300 md:p-0 {{ request()->routeIs('structure') ? 'md:text-teal-600 dark:md:text-teal-300' : '' }} transition-colors">Structure</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                        class="block py-2 pl-3 pr-4 text-teal-800 dark:text-teal-200 rounded hover:bg-teal-100 dark:hover:bg-teal-900 md:hover:bg-transparent md:border-0 md:hover:text-teal-600 dark:md:hover:text-teal-300 md:p-0 {{ request()->routeIs('contact') ? 'md:text-teal-600 dark:md:text-teal-300' : '' }} transition-colors">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{--
  SKRIP UNTUK HAMBURGER MENU:
  Skrip ini sekarang ada di dalam file header.blade.php
  agar file ini mandiri dan berfungsi.
--}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.querySelector('[data-collapse-toggle="navbar-default"]');
        const menu = document.getElementById('navbar-default');

        if (button && menu) {
            button.addEventListener('click', function() {
                menu.classList.toggle('hidden');

                // Memperbarui atribut aria-expanded untuk aksesibilitas
                const isExpanded = !menu.classList.contains('hidden');
                button.setAttribute('aria-expanded', isExpanded.toString());
            });
        }
    });
</script>
