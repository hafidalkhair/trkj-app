<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
{{-- Menghapus 'class=""' di atas akan mencegah FOUC (Flash of Unstyled Content) jika mode gelap diaktifkan --}}
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

    {{-- Judul yang lebih fleksibel, bisa di-override dari halaman child --}}
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

    {{-- Stack untuk gaya kustom per halaman (jika diperlukan) --}}
    @stack('head-styles')
</head>

{{--
  MODIFIKASI DI BAWAH:
  1. text-teal-900 -> text-slate-800 (Warna teks utama lebih netral dan lembut)
  2. dark:text-teal-100 -> dark:text-teal-200 (Teks di mode gelap sedikit diredam agar tidak terlalu kontras)
--}}
{{--
  UPDATE:
  Mengganti palet warna dasar dari 'teal' (sage) ke 'slate' (netral)
  untuk tampilan yang paling simpel dan minimalis.
--}}
<body class="font-sans antialiased bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-200 transition-colors duration-300 ease-in-out">


    <div class="flex flex-col min-h-screen">

        <!-- Navigation -->
        @include('partials.header')

        <main class="flex-grow pt-16">
            {{ $slot }}
        </main>

        {{-- Footer Content --}}
        @include('partials.footer')

    </div> {{-- Akhir dari wrapper min-h-screen --}}

    @stack('scripts')
</body>

</html>
