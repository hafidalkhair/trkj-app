<x-app-layout>
    <!-- Header Section -->
    <section class="relative pt-40 pb-20 px-6 bg-slate-50 dark:bg-slate-950 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-30 pointer-events-none">
            <div class="absolute top-20 left-20 w-72 h-72 bg-teal-500/20 rounded-full blur-3xl mix-blend-multiply animate-blob"></div>
            <div class="absolute top-20 right-20 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl mix-blend-multiply animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto text-center">
            <span class="inline-block py-2 px-4 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-xs font-bold mb-6 tracking-widest uppercase animate__animated animate__fadeInDown">
                Our Memories
            </span>
            <h1 class="text-5xl md:text-7xl font-bold text-slate-900 dark:text-white mb-8 tracking-tight animate__animated animate__fadeInUp animate__delay-1s">
                Visual <span class="text-teal-600">Diaries.</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed animate__animated animate__fadeInUp animate__delay-2s">
                Every picture tells a story. Here is the collection of our best moments, frozen in time for us to cherish forever.
            </p>
        </div>
    </section>

    <!-- Main Gallery Content -->
    <section class="pb-32 px-6 min-h-screen bg-slate-50 dark:bg-slate-950"
        x-data="{
            view: 'categories',
            selectedCategory: null,
            selectedPhoto: null,
            showSlideshow: false,
            zoomLevel: 1, // Fitur Zoom

            init() {
                this.$watch('showSlideshow', value => {
                    document.body.style.overflow = value ? 'hidden' : 'auto';
                    if (!value) this.zoomLevel = 1; // Reset zoom saat close
                });
            },

            showAlbum(categoryId) {
                this.selectedCategory = categoryId;
                this.view = 'album';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            },

            showCategories() {
                this.view = 'categories';
                this.selectedCategory = null;
            },

            openSlideshow(index) {
                this.selectedPhoto = index;
                this.showSlideshow = true;
                this.zoomLevel = 1;
            },

            closeSlideshow() {
                this.showSlideshow = false;
                this.selectedPhoto = null;
            },

            toggleZoom() {
                this.zoomLevel = this.zoomLevel === 1 ? 2 : 1;
            },

            nextPhoto(total) {
                this.selectedPhoto = (this.selectedPhoto + 1) % total;
                this.zoomLevel = 1; // Reset zoom saat ganti foto
            },
            prevPhoto(total) {
                this.selectedPhoto = (this.selectedPhoto - 1 + total) % total;
                this.zoomLevel = 1;
            }
        }"
        @keydown.escape.window="showSlideshow && closeSlideshow()">

        <div class="max-w-screen-xl mx-auto">

            <!-- VIEW 1: ALBUM GRID (CATEGORIES) -->
            <div x-show="view === 'categories'"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-y-10 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($categories as $category)
                    <div class="group relative w-full aspect-[4/3] rounded-3xl overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl hover:shadow-teal-900/20 transition-all duration-700 hover:-translate-y-2"
                         @click="showAlbum('{{ $category->id }}')">

                        <!-- Efek Zoom Out saat Hover (Scale 1.1 -> 1.0) -->
                        <img src="{{ asset('storage/' . $category->cover_image) }}"
                             alt="{{ $category->name }}"
                             class="absolute inset-0 w-full h-full object-cover object-center transform scale-110 group-hover:scale-100 transition-transform duration-1000 ease-out">

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-80 transition-opacity duration-500"></div>

                        <div class="absolute bottom-0 left-0 p-8 w-full translate-y-4 group-hover:translate-y-0 transition-transform duration-500 ease-out">
                            <p class="text-teal-400 text-xs font-bold uppercase tracking-widest mb-2">{{ $category->photos->count() }} PHOTOS</p>
                            <h2 class="text-3xl font-bold text-white mb-2">{{ $category->name }}</h2>
                            <p class="text-slate-300 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                {{ $category->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- VIEW 2: PHOTOS INSIDE ALBUM -->
            @foreach($categories as $category)
                <div x-show="selectedCategory === '{{ $category->id }}' && view === 'album'" x-cloak>

                    <!-- Breadcrumb -->
                    <div class="flex items-center justify-between mb-12 animate__animated animate__fadeInDown">
                        <button @click="showCategories()" class="group flex items-center text-slate-600 dark:text-slate-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors font-medium">
                            <span class="w-10 h-10 rounded-full border border-slate-200 dark:border-slate-800 flex items-center justify-center mr-3 group-hover:border-teal-500 group-hover:bg-teal-50 dark:group-hover:bg-teal-900/20 transition-all">
                                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </span>
                            Back to Albums
                        </button>
                        <div class="text-right">
                            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $category->name }}</h2>
                            <p class="text-slate-500 text-sm mt-1">{{ $category->photos->count() }} items</p>
                        </div>
                    </div>

                    <!-- Photos Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                        @foreach($category->photos as $index => $photo)
                            <div class="group relative aspect-square rounded-2xl overflow-hidden cursor-zoom-in bg-slate-200 dark:bg-slate-800 animate__animated animate__fadeInUp"
                                 style="animation-delay: {{ $index * 50 }}ms"
                                 @click="openSlideshow({{ $index }})">

                                <!-- Efek Zoom Out Lembut pada Foto Individual -->
                                <img src="{{ asset('storage/'. $photo->image_path) }}"
                                     alt="Photo"
                                     class="w-full h-full object-cover transform scale-110 group-hover:scale-100 transition-transform duration-700 ease-out">

                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300">
                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 scale-0 group-hover:scale-100">
                                        <svg class="w-8 h-8 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- SLIDESHOW MODAL (Full Screen with Zoom) -->
                    <template x-if="showSlideshow && selectedCategory === '{{ $category->id }}'">
                        <div class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-xl flex items-center justify-center"
                             @click.self="closeSlideshow()"
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0">

                            <!-- Toolbar -->
                            <div class="absolute top-0 left-0 w-full p-6 flex justify-between items-center z-50">
                                <span class="text-white/70 text-sm font-medium tracking-widest">
                                    <span x-text="selectedPhoto + 1"></span> / <span x-text="photos.length"></span>
                                </span>
                                <div class="flex items-center gap-4">
                                    <!-- Zoom Toggle Button -->
                                    <button @click="toggleZoom()" class="text-white/70 hover:text-white transition-colors p-2" title="Toggle Zoom">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                    </button>
                                    <button class="text-white/50 hover:text-white transition-colors p-2" @click="closeSlideshow()">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Image Container -->
                            <div class="relative w-full h-full flex items-center justify-center px-4 md:px-20 py-10" x-data="{ photos: {{ $category->photos->toJson() }} }">

                                <!-- Navigation Left -->
                                <button class="absolute left-4 md:left-8 text-white/50 hover:text-white hover:scale-110 transition-all p-4 bg-black/20 rounded-full backdrop-blur-sm z-50"
                                        @click.stop="prevPhoto(photos.length)">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </button>

                                <!-- Active Photo -->
                                <template x-for="(photo, idx) in photos" :key="idx">
                                    <div x-show="selectedPhoto === idx"
                                         class="flex flex-col items-center justify-center w-full h-full"
                                         x-transition:enter="transition ease-out duration-500"
                                         x-transition:enter-start="opacity-0 scale-90"
                                         x-transition:enter-end="opacity-100 scale-100">

                                        <!-- Wrapper untuk Zoom -->
                                        <div class="relative overflow-hidden cursor-move transition-transform duration-500 ease-out"
                                             :class="{ 'scale-150': zoomLevel > 1 }"
                                             @click="toggleZoom()">
                                            <img :src="'/storage/' + photo.image_path"
                                                 class="max-w-full max-h-[80vh] rounded shadow-2xl object-contain"
                                                 alt="Gallery Image">
                                        </div>

                                        <!-- Caption (Hanya muncul jika tidak di-zoom) -->
                                        <div class="mt-6 text-center transition-opacity duration-300" :class="{ 'opacity-0': zoomLevel > 1 }">
                                            <p class="text-white text-xl font-medium" x-text="photo.caption"></p>
                                            <p class="text-white/50 text-sm mt-1" x-show="photo.event_date" x-text="new Date(photo.event_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })"></p>
                                        </div>
                                    </div>
                                </template>

                                <!-- Navigation Right -->
                                <button class="absolute right-4 md:right-8 text-white/50 hover:text-white hover:scale-110 transition-all p-4 bg-black/20 rounded-full backdrop-blur-sm z-50"
                                        @click.stop="nextPhoto(photos.length)">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            @endforeach

        </div>
    </section>
</x-app-layout>
