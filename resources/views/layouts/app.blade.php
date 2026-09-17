<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> <!-- Fix zoom iOS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'TRKJ') }}</title>
    <meta name="description" content="{{ $description ?? 'TRKJ — komunitas dan organisasi digital dengan galeri kegiatan, struktur anggota, dan informasi terkini.' }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

    <!-- FONT: Clash Display dari Fontshare -->
    <link rel="preconnect" href="https://api.fontshare.com" crossorigin>
    <link href="https://api.fontshare.com/v2/css?f[]=clash-display@200,300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head-styles')

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #0d9488; /* Teal-600 */
            border-radius: 999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #0f766e;
        }

        .no-scroll {
            overflow: hidden;
        }

        [x-cloak] { display: none !important; }

        @keyframes loading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(200%); }
        }
    </style>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300 ease-in-out selection:bg-teal-500 selection:text-white no-scroll"
      x-data="{ loading: true }"
      x-init="setTimeout(() => { loading = false; document.body.classList.remove('no-scroll') }, 900)">

    <!-- Preloader -->
    <div x-show="loading"
         x-transition:leave="transition ease-in duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center bg-white dark:bg-slate-950">
        <div class="text-center">
            <div class="w-12 h-12 rounded-2xl bg-teal-600 text-white flex items-center justify-center font-bold text-xl shadow-brand mb-5 mx-auto animate-pulse">
                T
            </div>
            <div class="w-24 h-1 rounded-full bg-slate-100 dark:bg-slate-800 mx-auto overflow-hidden">
                <div class="h-full w-1/2 bg-teal-600 rounded-full animate-[loading_1s_ease-in-out_infinite]"></div>
            </div>
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
