<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> <!-- Fix zoom iOS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Class Portfolio') }}</title>

    <!-- FONT: Clash Display dari Fontshare -->
    <link href="https://api.fontshare.com/v2/css?f[]=clash-display@200,300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head-styles')

    <style>
        /* Set Font Global ke Clash Display */
        body {
            font-family: 'Clash Display', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #0d9488; /* Teal-600 */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #0f766e;
        }

        .no-scroll {
            overflow: hidden;
        }

        [x-cloak] { display: none !important; }
    </style>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="antialiased bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300 ease-in-out selection:bg-teal-500 selection:text-white no-scroll"
      x-data="{ loading: true }"
      x-init="setTimeout(() => { loading = false; document.body.classList.remove('no-scroll') }, 1000)">

    <!-- Modern Preloader -->
    <div x-show="loading"
         x-transition:leave="transition ease-in duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center bg-white dark:bg-slate-950">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-teal-200 border-t-teal-600 rounded-full animate-spin mb-4 mx-auto"></div>
            <h2 class="text-xl font-semibold text-teal-800 dark:text-teal-200 animate-pulse tracking-wider">LOADING...</h2>
        </div>
    </div>

    <div class="flex flex-col min-h-screen opacity-0"
         :class="{ 'opacity-100': !loading }"
         class="transition-opacity duration-700">

        @include('partials.header')

        <main class="flex-grow">
            {{ $slot }}
        </main>

        @include('partials.footer')

    </div>

    @stack('scripts')
</body>
</html>
