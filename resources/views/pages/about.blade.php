<x-app-layout>
    <x-slot name="title">Tentang Kami</x-slot>

    <!-- 1. HERO -->
    <section class="relative pt-40 pb-16 px-6 overflow-hidden text-center bg-slate-50 dark:bg-slate-950">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
            <div class="absolute top-10 left-1/4 w-[500px] h-[500px] bg-teal-500/10 dark:bg-teal-900/20 rounded-full blur-[120px] opacity-50"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto animate__animated animate__fadeInDown">
            <span class="inline-block py-2 px-5 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-teal-600 dark:text-teal-400 text-[11px] font-bold tracking-[0.2em] uppercase mb-8 shadow-lg">
                Who We Are
            </span>
            <h1 class="text-5xl md:text-7xl font-bold text-slate-900 dark:text-white mb-6 tracking-tight leading-tight">
                More Than a Class. <br>
                <span class="text-teal-600">A Family.</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed font-light">
                Kami adalah kumpulan pelajar yang tumbuh bersama, saling mendukung, dan berkomitmen membangun
                kenangan sekaligus masa depan yang lebih baik.
            </p>
        </div>
    </section>

    <!-- 2. STORY -->
    <section class="py-24 px-6 bg-white dark:bg-slate-900">
        <div class="max-w-screen-xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="animate__animated animate__fadeInLeft">
                <span class="inline-block py-2 px-4 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-xs font-bold mb-6 tracking-widest uppercase">
                    Our Story
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-6 leading-tight">
                    Dibangun dari kebersamaan, tumbuh melalui kolaborasi.
                </h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                    Lebih dari sekadar kelas, kami adalah komunitas yang saling menguatkan satu sama lain. Bersama,
                    kami berusaha meraih prestasi akademik terbaik sambil menciptakan kenangan dan persahabatan
                    yang akan terus dikenang.
                </p>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                    Kami percaya pada kekuatan kolaborasi, kreativitas, dan pembelajaran yang berkelanjutan.
                    Keberagaman bakat dan komitmen bersama untuk terus berkembang membuat kelas kami unik dan istimewa.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="bg-slate-50 dark:bg-slate-800 rounded-3xl p-8 border border-slate-100 dark:border-slate-700 shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-teal-600 dark:text-teal-400">{{ 2023 }}</h3>
                    <p class="text-xs text-slate-500 uppercase tracking-widest font-bold mt-2">Angkatan</p>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800 rounded-3xl p-8 border border-slate-100 dark:border-slate-700 shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-teal-600 dark:text-teal-400">{{ $totalMembers }}</h3>
                    <p class="text-xs text-slate-500 uppercase tracking-widest font-bold mt-2">Members</p>
                </div>
                <div class="col-span-2 bg-teal-600 rounded-3xl p-8 shadow-xl shadow-teal-600/20 text-center">
                    <h3 class="text-xl font-bold text-white">Satu Tujuan, Satu Perjalanan</h3>
                    <p class="text-teal-100 text-sm mt-2">Tumbuh bersama menuju kesuksesan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISION & MISSION -->
    <section class="py-24 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-screen-xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6">Vision &amp; Mission</h2>
                <div class="w-24 h-1.5 bg-teal-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-lg border border-slate-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-2xl hover:border-teal-200 dark:hover:border-teal-800 transition-all duration-300">
                    <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/40 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Our Vision</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                        Menjadi komunitas belajar yang solid dan saling mendukung, yang memberdayakan setiap anggota
                        untuk mencapai potensi terbaiknya sambil membangun persahabatan dan pengalaman yang bermakna.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-lg border border-slate-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-2xl hover:border-teal-200 dark:hover:border-teal-800 transition-all duration-300">
                    <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/40 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Our Mission</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                        Menciptakan lingkungan inklusif yang mendorong prestasi akademik, pertumbuhan pribadi, dan
                        ikatan yang kuat antar anggota melalui kolaborasi, dukungan bersama, dan pengalaman yang dibagikan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. LEADERSHIP TEASER -->
    <section class="py-24 px-6 bg-white dark:bg-slate-900">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div>
                    <span class="inline-block py-2 px-4 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-xs font-bold mb-4 tracking-widest uppercase">
                        Organization
                    </span>
                    <h2 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white">Leadership Team</h2>
                </div>
                <a href="{{ route('structure') }}"
                   class="group text-teal-600 font-bold hover:text-teal-800 mt-6 md:mt-0 flex items-center transition-colors">
                    See Full Structure
                    <span class="bg-teal-100 dark:bg-teal-900 p-2 rounded-full ml-3 group-hover:bg-teal-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse ($leaders as $leader)
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-100 dark:border-slate-700 shadow-lg hover:shadow-2xl hover:-translate-y-2 hover:border-teal-200 dark:hover:border-teal-800 transition-all duration-300 text-center">
                        <div class="relative w-20 h-20 mx-auto mb-5 rounded-full overflow-hidden border-4 border-teal-50 dark:border-teal-900 group-hover:border-teal-500 transition-colors shadow-md">
                            <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}"
                                 class="w-full h-full object-cover object-center transform group-hover:scale-110 transition-transform duration-500"
                                 alt="{{ $leader->full_name }}">
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-teal-600 transition-colors">
                            {{ $leader->full_name }}
                        </h3>
                        <span class="inline-block bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 text-xs font-bold px-3 py-1.5 rounded-full mt-2 uppercase tracking-wide border border-teal-100 dark:border-teal-800">
                            {{ $leader->position }}
                        </span>
                    </div>
                @empty
                    <p class="text-slate-500 col-span-full text-center">Data kepengurusan belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. CTA -->
    <section class="py-24 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-screen-xl mx-auto">
            <div class="relative bg-teal-600 rounded-3xl px-8 py-16 md:py-20 text-center overflow-hidden shadow-2xl shadow-teal-900/20">
                <div class="absolute top-0 right-0 -mr-24 -mt-24 w-72 h-72 rounded-full bg-teal-500/40 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-72 h-72 rounded-full bg-teal-800/40 blur-3xl"></div>

                <div class="relative z-10 max-w-2xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ingin tahu lebih banyak tentang kami?</h2>
                    <p class="text-teal-100 mb-10 leading-relaxed">
                        Jelajahi galeri kegiatan kami atau hubungi langsung untuk kolaborasi dan pertanyaan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('gallery') }}"
                           class="px-8 py-4 bg-white rounded-full text-teal-700 font-semibold shadow-xl transition-all hover:scale-105">
                            Explore Gallery
                        </a>
                        <a href="{{ route('contact') }}"
                           class="px-8 py-4 rounded-full border border-white/30 text-white font-semibold hover:bg-white/10 backdrop-blur-md transition-all hover:border-white hover:scale-105">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
