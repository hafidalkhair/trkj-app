<x-app-layout>
    <!-- 1. HERO SECTION -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <!-- Background Slider -->
        <div class="absolute inset-0 z-0 bg-slate-900" x-data="{ activeSlide: 0, slides: {{ $latestPhotos->pluck('photos')->flatten()->take(5)->pluck('image_path')->map(fn($p) => asset('storage/' . $p)) }} }" x-init="setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 6000)">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                    :class="{ 'opacity-100': activeSlide === index, 'opacity-0': activeSlide !== index }">
                    <!-- Object-center penting agar wajah tidak terpotong di mobile -->
                    <img :src="slide" class="w-full h-full object-cover object-center animate-ken-burns"
                        alt="Hero Background">
                    <div
                        class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-900/40 to-slate-50 dark:to-slate-950">
                    </div>
                </div>
            </template>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center px-6 max-w-5xl mx-auto pt-32 md:pt-48 pb-24">
            <span
                class="inline-block py-2 px-4 rounded-full bg-white/10 border border-white/20 text-white text-sm font-semibold mb-6 backdrop-blur-sm animate__animated animate__fadeInDown shadow-lg tracking-widest">
                CLASS OF {{ date('Y') }}
            </span>

            <!-- Responsive Typography untuk Clash Display -->
            <h1
                class="text-4xl sm:text-5xl md:text-7xl lg:text-8xl font-bold text-white mb-6 tracking-tight leading-tight animate__animated animate__fadeInUp animate__delay-1s drop-shadow-2xl">
                Creating Memories <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-teal-100">Building
                    Futures.</span>
            </h1>

            <p
                class="text-base sm:text-lg md:text-xl text-slate-200 max-w-2xl mx-auto mb-10 font-light leading-relaxed animate__animated animate__fadeInUp animate__delay-2s drop-shadow-md px-4">
                Welcome to the official digital portfolio of our class. A collection of moments, achievements, and the
                beautiful journey we share together.
            </p>

            <div
                class="flex flex-col sm:flex-row gap-4 justify-center animate__animated animate__fadeInUp animate__delay-3s px-4">
                <a href="{{ route('gallery') }}"
                    class="group relative w-full sm:w-auto px-8 py-4 bg-teal-600 rounded-full text-white font-semibold overflow-hidden shadow-xl shadow-teal-600/30 transition-all hover:scale-105 hover:shadow-teal-600/50">
                    <span class="relative z-10 flex items-center justify-center">
                        Explore Gallery
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                    <div
                        class="absolute inset-0 h-full w-full scale-0 rounded-full transition-all duration-300 group-hover:scale-100 group-hover:bg-teal-700/50">
                    </div>
                </a>
                <a href="{{ route('structure') }}"
                    class="w-full sm:w-auto px-8 py-4 rounded-full border border-white/30 text-white font-semibold hover:bg-white/10 backdrop-blur-md transition-all hover:border-white hover:scale-105 hover:shadow-lg flex justify-center items-center">
                    Our Team
                </a>
            </div>
        </div>

        <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 animate-bounce text-white/70">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                </path>
            </svg>
        </div>
    </section>

    <!-- 2. STATS BAR -->


<div class="relative z-20 -mt-24 px-6">
    <div
        class="max-w-5xl mx-auto bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-slate-100 dark:border-slate-700 p-8 md:p-12 flex flex-col md:flex-row justify-around text-center backdrop-blur-xl bg-opacity-95 dark:bg-opacity-95 gap-8 md:gap-0">

        <!-- MEMBERS -->
        <div class="p-2">
            <h3 class="text-4xl md:text-5xl font-bold text-teal-600 dark:text-teal-400 counter-animate"
                x-data="{ count: 0 }" x-intersect="count = {{ $totalMembers }}"
                x-effect="let i=0; const interval=setInterval(()=>{if(i>=count){clearInterval(interval)}else{i++;$el.innerText=i}}, 100)">
                0
            </h3>
            <p class="text-xs md:text-sm text-slate-500 uppercase tracking-widest font-bold mt-2">Members</p>
        </div>

        <div class="w-px bg-slate-200 dark:bg-slate-700 hidden md:block h-20 self-center"></div>
        <div class="h-px bg-slate-200 dark:bg-slate-700 w-full block md:hidden"></div>

        <!-- ALBUMS -->
        <div class="p-2">
            <h3 class="text-4xl md:text-5xl font-bold text-teal-600 dark:text-teal-400">
                {{ $totalCategories }}
            </h3>
            <p class="text-xs md:text-sm text-slate-500 uppercase tracking-widest font-bold mt-2">Albums</p>
        </div>

        <div class="w-px bg-slate-200 dark:bg-slate-700 hidden md:block h-20 self-center"></div>
        <div class="h-px bg-slate-200 dark:bg-slate-700 w-full block md:hidden"></div>

        <!-- ESTABLISHED -->
        <div class="p-2">
            <h3 class="text-4xl md:text-5xl font-bold text-teal-600 dark:text-teal-400">{{ date('Y') }}</h3>
            <p class="text-xs md:text-sm text-slate-500 uppercase tracking-widest font-bold mt-2">Established</p>
        </div>

    </div>
</div>



    <!-- 3. LATEST ALBUMS -->
    <section id="gallery" class="py-32 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-screen-xl mx-auto">
            <div class="text-center mb-20" x-data="{ show: false }" x-intersect.threshold.50="show = true">
                <h2 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6 transition-all duration-700 transform"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    Captured Moments
                </h2>
                <div class="w-24 h-1.5 bg-teal-500 mx-auto rounded-full mb-8 transition-all duration-700 delay-100 transform"
                    :class="show ? 'w-24 opacity-100' : 'w-0 opacity-0'"></div>
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto transition-all duration-700 delay-200 transform leading-relaxed"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    A glimpse into our latest activities and unforgettable events.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($latestPhotos as $index => $category)
                    <div class="group relative w-full aspect-[4/3] rounded-3xl overflow-hidden cursor-pointer transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:shadow-teal-900/20 border border-slate-200 dark:border-slate-800"
                        x-data="{ show: false }" x-intersect.threshold.20="show = true"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-20'"
                        style="transition-delay: {{ $index * 100 }}ms">

                        <img src="{{ asset('storage/' . $category->cover_image) }}" alt="{{ $category->name }}"
                            class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-1000 group-hover:scale-110">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-500">
                        </div>

                        <div
                            class="absolute bottom-0 left-0 w-full p-6 md:p-8 translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                            <div
                                class="flex items-center gap-3 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                <span
                                    class="bg-teal-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">NEW</span>
                                <span
                                    class="text-slate-200 text-xs uppercase tracking-widest font-semibold">{{ $category->created_at->format('M Y') }}</span>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-white mb-3 leading-tight">
                                {{ $category->name }}</h3>
                            <p
                                class="text-slate-300 text-sm line-clamp-2 mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-200 leading-relaxed">
                                {{ $category->description }}
                            </p>
                            <a href="{{ route('gallery') }}"
                                class="inline-flex items-center text-teal-300 font-bold tracking-wide group-hover:text-teal-200 transition-colors">
                                VIEW ALBUM <svg
                                    class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. QUOTE SECTION -->
    <section class="py-32 md:py-40 relative bg-teal-900 overflow-hidden flex items-center justify-center">
        <div
            class="absolute top-0 right-0 -mr-32 -mt-32 w-[20rem] md:w-[32rem] h-[20rem] md:h-[32rem] rounded-full bg-teal-500/20 blur-3xl animate-pulse">
        </div>
        <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-[18rem] md:w-[28rem] h-[18rem] md:h-[28rem] rounded-full bg-blue-500/20 blur-3xl animate-pulse"
            style="animation-duration: 4s"></div>

        <div class="max-w-5xl mx-auto px-6 text-center relative z-10" x-data="{ show: false }" x-intersect="show = true">
            <svg class="w-16 h-16 md:w-20 md:h-20 text-teal-400/40 mx-auto mb-8 md:mb-12" fill="currentColor"
                viewBox="0 0 24 24">
                <path
                    d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM5.01697 21L5.01697 18C5.01697 16.8954 5.9124 16 7.01697 16H10.017C10.5693 16 11.017 15.5523 11.017 15V9C11.017 8.44772 10.5693 8 10.017 8H6.01697C5.46468 8 5.01697 8.44772 5.01697 9V11C5.01697 11.5523 4.56925 12 4.01697 12H3.01697V5H13.017V15C13.017 18.3137 10.3307 21 7.01697 21H5.01697Z">
                </path>
            </svg>

            <h2 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-medium italic text-white leading-relaxed mb-8 md:mb-12 transition-all duration-1000 transform px-4"
                :class="show ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">
                "We are not just a class, we are a story waiting to be told. Every laugh, every challenge, every success
                binds us closer."
            </h2>

            <div class="flex items-center justify-center gap-6 transition-all duration-1000 delay-300"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <div class="w-12 md:w-16 h-px bg-teal-400/50"></div>
                <span class="text-teal-200 font-bold tracking-[0.2em] uppercase text-xs md:text-sm">Class
                    Representative</span>
                <div class="w-12 md:w-16 h-px bg-teal-400/50"></div>
            </div>
        </div>
    </section>

    <!-- 5. LEADERSHIP TEAM -->
    <section class="py-32 px-6">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20">
                <div>
                    <h2 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4">Meet the Leaders
                    </h2>
                    <p class="text-lg text-slate-500">The people working behind the scenes.</p>
                </div>
                <a href="{{ route('structure') }}"
                    class="group text-teal-600 font-bold text-lg hover:text-teal-800 mt-8 md:mt-0 flex items-center transition-colors">
                    See Full Structure
                    <span
                        class="bg-teal-100 dark:bg-teal-900 p-2 rounded-full ml-3 group-hover:bg-teal-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($members as $member)
                    @if (in_array($member->position, ['komisaris', 'sekretaris', 'bendahara']))
                        <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-100 dark:border-slate-700 shadow-lg hover:shadow-2xl hover:-translate-y-2 hover:border-teal-200 dark:hover:border-teal-800 transition-all duration-300"
                            x-data="{ show: false }" x-intersect="show = true"
                            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                            <div class="flex items-center gap-6">
                                <div
                                    class="relative w-20 h-20 md:w-24 md:h-24 rounded-full overflow-hidden border-4 border-teal-50 dark:border-teal-900 group-hover:border-teal-500 transition-colors shadow-md shrink-0">
                                    <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}"
                                        class="w-full h-full object-cover object-center transform group-hover:scale-110 transition-transform duration-500"
                                        alt="Leader">
                                </div>
                                <div>
                                    <h3
                                        class="text-lg md:text-xl font-bold text-slate-900 dark:text-white group-hover:text-teal-600 transition-colors">
                                        {{ $member->full_name }}</h3>
                                    <span
                                        class="inline-block bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 text-xs font-bold px-3 py-1.5 rounded-full mt-2 uppercase tracking-wide border border-teal-100 dark:border-teal-800">
                                        {{ $member->position }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-8 pt-8 border-t border-slate-100 dark:border-slate-700">
                                <p class="text-slate-500 text-base italic leading-relaxed">
                                    "{{ Str::limit($member->favorite_quote ?? 'Always do your best.', 80) }}"</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- 6. FEATURED MESSAGES -->
    <section class="py-32 px-6 bg-white dark:bg-slate-950">
        <div class="max-w-screen-xl mx-auto">

            <!-- Title -->
            <div class="text-center mb-20" x-data="{ show: false }" x-intersect="show = true">
                <h2 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-6 transition-all duration-700 transform"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    Voices & Messages
                </h2>
                <div class="w-24 h-1.5 bg-teal-500 mx-auto rounded-full mb-8 transition-all duration-700 delay-100 transform"
                    :class="show ? 'w-24 opacity-100' : 'w-0 opacity-0'"></div>
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto transition-all duration-700 delay-200 transform leading-relaxed"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    Special messages chosen by our team to highlight thoughts, appreciation, and gratitude.
                </p>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($testimonials as $msg)
                    <div
                        class="group bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-3xl p-8 shadow-xl hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">

                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-12 h-12 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold shadow">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $msg->name }}</h3>
                                <span class="text-xs text-slate-500">{{ $msg->email }}</span>
                            </div>
                        </div>

                        <span
                            class="inline-block bg-teal-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow mb-4">
                            {{ $msg->subject }}
                        </span>

                        <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-6 italic">
                            "{{ $msg->message }}"
                        </p>

                        <div class="text-right text-xs text-slate-400 font-semibold">
                            {{ $msg->created_at->diffForHumans() }}
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    @push('head-styles')
        <style>
            @keyframes ken-burns {
                0% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(1.1);
                }
            }

            .animate-ken-burns {
                animation: ken-burns 12s ease-out infinite alternate;
            }
        </style>
    @endpush
</x-app-layout>
