<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
{{-- Skrip ini harus dijalankan sebelum apa pun untuk mencegah FOUC --}}
<script>
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Class Portfolio') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head-styles')
</head>

<body class="font-sans antialiased bg-teal-50 text-teal-900 dark:bg-teal-950 dark:text-teal-100 transition-colors duration-300 ease-in-out">


    <div class="flex flex-col min-h-screen">

        <!-- Navigation -->
        {{-- Ini akan memuat header DAN skrip hamburger di dalamnya --}}
        @include('partials.header')

        <!-- Page Content -->
        <main class="flex-grow pt-16">
            {{ $slot }}
        </main>

        {{-- Footer Content --}}
        @include('partials.footer')

    </div> {{-- Akhir dari wrapper min-h-screen --}}

    @stack('scripts')

    {{--
      SKRIP HAMBURGER DUPLIKAT TELAH DIHAPUS DARI SINI
      untuk mencegah konflik.
    --}}
</body>

</html>
