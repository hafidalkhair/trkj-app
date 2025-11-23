<x-app-layout>
    <x-slot name="title">Galeri Kegiatan</x-slot>

    <!-- Wrapper Utama -->
    <div class="min-h-screen bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white font-sans overflow-x-hidden transition-colors duration-300">

        <!-- HEADER SECTION -->
        <section class="relative pt-40 pb-12 px-6 overflow-hidden text-center" id="gallery-header">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
                <div class="absolute top-10 left-1/4 w-[500px] h-[500px] bg-teal-500/10 dark:bg-teal-900/20 rounded-full blur-[120px] opacity-50"></div>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto animate__animated animate__fadeInDown">
                <span class="inline-block py-2 px-5 rounded-full bg-white dark:bg-[#1E293B] border border-slate-200 dark:border-slate-800 text-teal-600 dark:text-teal-400 text-[11px] font-bold tracking-[0.2em] uppercase mb-8 shadow-lg">
                    Our Memories
                </span>
                <h1 class="text-6xl md:text-8xl font-bold text-slate-900 dark:text-white mb-6 tracking-tighter leading-none">
                    Visual <span class="text-teal-500">Diaries.</span>
                </h1>
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl mx-auto leading-relaxed font-light">
                    Koleksi momen berharga kami.
                </p>
            </div>
        </section>

        <!-- MAIN CONTENT AREA -->
        <section id="gallery-content" class="pb-32 px-4 md:px-8 max-w-screen-xl mx-auto min-h-[600px]"
            x-data="galleryComponent()"
            x-init="initGallery()"
            @keydown.escape.window="handleEscape()">

            <!-- ===========================
                 VIEW 1: LIST ALBUM (CATEGORIES)
                 =========================== -->
            <div x-show="view === 'albums'"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 -translate-x-10"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 -translate-x-10">

                <!-- Toolbar Album (REFINED DROPDOWN STYLE) -->
                <div class="sticky top-24 z-30 mb-14 px-2 md:px-0">
                    <div class="bg-white/90 dark:bg-[#1E293B]/90 border border-slate-200 dark:border-slate-700/50
                                rounded-2xl md:rounded-full shadow-2xl
                                flex flex-col md:flex-row items-center
                                max-w-3xl mx-auto backdrop-blur-xl p-2 md:p-1.5 ring-1 ring-slate-900/5 transition-all duration-300">

                        <!-- Search Bar -->
                        <div class="relative flex-grow w-full md:w-auto flex items-center px-4 h-12 md:h-auto">
                            <svg class="h-5 w-5 text-slate-400 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            <input type="text"
                                   x-model="albumSearch"
                                   placeholder="Cari album kegiatan..."
                                   class="w-full bg-transparent border-none focus:ring-0 text-sm font-medium text-slate-900 dark:text-white placeholder-slate-500 p-0 focus:outline-none">
                        </div>

                        <!-- Divider -->
                        <div class="w-full h-px bg-slate-100 dark:bg-slate-700/50 md:w-px md:h-8 md:bg-slate-200 md:dark:bg-slate-700 my-1 md:my-0 mx-0 md:mx-2"></div>

                        <!-- Filter Dropdown (CONSISTENT STYLE) -->
                        <div class="relative w-full md:w-auto min-w-[240px]">
                            <!-- Icon Indikator (Teal) -->
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-teal-500 dark:text-teal-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                            </div>

                            <!-- Select Element -->
                            <select x-model="selectedCategoryId"
                                    class="w-full h-12 md:h-auto pl-5 pr-12 py-2 bg-transparent border-none focus:ring-0 rounded-xl text-sm font-bold text-slate-700 dark:text-white appearance-none cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors focus:outline-none">

                                <!-- Options dengan Background Color yang Sesuai -->
                                <option value="all" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white py-2">
                                    Semua Album
                                </option>
                                <template x-for="cat in categories" :key="cat.id">
                                    <option :value="cat.id" x-text="cat.name" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-white py-2"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Grid Album -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-2">
                    <template x-for="category in paginatedCategories" :key="category.id">
                        <div @click="openCategory(category)"
                             class="group cursor-pointer relative flex flex-col overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-lg transition-all duration-300 ease-in-out hover:scale-[1.02] hover:border-teal-500/50 hover:shadow-2xl hover:shadow-teal-500/10">

                            <!-- Image Area -->
                            <div class="relative aspect-[4/3] w-full overflow-hidden bg-slate-100 dark:bg-slate-800">
                                <img :src="getCategoryCover(category)"
                                     class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110 opacity-95 group-hover:opacity-100">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-60"></div>
                                <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md border border-white/10 text-white px-2.5 py-1 rounded-md text-[10px] font-bold tracking-wider shadow-sm">
                                    <span x-text="category.photos_count"></span> FOTO
                                </div>
                            </div>

                            <div class="flex flex-col gap-2 p-5">
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white group-hover:text-teal-500 transition-colors line-clamp-1" x-text="category.name"></h3>
                                <div class="flex items-center justify-between mt-1 pt-3 border-t border-slate-100 dark:border-slate-800">
                                    <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1 w-2/3" x-text="category.description || 'Album Kegiatan'"></p>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 group-hover:text-teal-500 flex items-center gap-1 transition-colors">
                                        LIHAT <span class="text-sm">&rarr;</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                 <!-- Empty State -->
                 <div x-show="filteredCategories.length === 0" class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 dark:bg-slate-800/50 mb-6 ring-1 ring-slate-200 dark:ring-slate-700">
                        <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Album Tidak Ditemukan</h3>
                    <p class="text-slate-500 mt-2">Coba kata kunci lain atau reset filter.</p>
                </div>

                <!-- Pagination -->
                <div x-show="totalCategoryPages > 1" class="mt-16 flex justify-center">
                    <div class="inline-flex items-center gap-2 p-2 bg-white dark:bg-[#1E293B] rounded-full border border-slate-200 dark:border-slate-800 shadow-xl">
                        <button @click="prevCatPage()" :disabled="currentCatPage === 1"
                                class="p-3 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 disabled:opacity-30 disabled:hover:bg-transparent transition text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider px-4">
                            Halaman <span class="text-slate-900 dark:text-white" x-text="currentCatPage"></span> / <span x-text="totalCategoryPages"></span>
                        </span>
                        <button @click="nextCatPage()" :disabled="currentCatPage === totalCategoryPages"
                                class="p-3 rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 disabled:opacity-30 disabled:hover:bg-transparent transition text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ===========================
                 VIEW 2: LIST PHOTOS (INSIDE ALBUM)
                 =========================== -->
            <div x-show="view === 'photos'"
                 style="display: none;"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 translate-x-10"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-10">

                <!-- Toolbar Foto -->
                <div class="sticky top-24 z-30 mb-8 flex flex-col md:flex-row gap-4 items-center justify-between bg-white/80 dark:bg-[#1E293B]/95 backdrop-blur-md p-3 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-lg ring-1 ring-slate-900/5">
                    <button @click="closeCategory()"
                            class="flex items-center gap-3 text-slate-600 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-400 transition-all font-bold uppercase text-[11px] tracking-widest pl-2 pr-4 py-2 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800">
                        <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center border border-slate-200 dark:border-slate-700 group-hover:border-teal-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </div>
                        Kembali
                    </button>

                    <div class="text-center hidden md:block">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white" x-text="activeCategory?.name"></h2>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-0.5" x-text="filteredPhotos.length + ' FOTO'"> </p>
                    </div>

                    <div class="relative w-full md:w-64">
                        <svg class="absolute left-3 top-2.5 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" x-model="photoSearch" placeholder="Cari caption..."
                               class="w-full pl-9 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-xs focus:border-teal-500 focus:ring-0 transition-all text-slate-700 dark:text-white placeholder-slate-500">
                    </div>
                </div>

                <!-- Grid Foto -->
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6 px-2">
                    <template x-for="(photo, index) in paginatedPhotos" :key="photo.id">
                        <div class="group relative aspect-[4/3] bg-slate-100 dark:bg-slate-800 rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-2xl transition-all duration-300 hover:scale-[1.02]"
                             @click="openSlideshow(index)">
                            <img :src="getPhotoUrl(photo.image_path)"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4 md:p-6">
                                <div class="w-full">
                                    <div class="h-0.5 w-8 bg-teal-500 mb-2"></div>
                                    <p class="text-white text-xs md:text-sm font-bold line-clamp-2 leading-relaxed" x-text="photo.caption || 'Tanpa caption'"></p>
                                    <p class="text-slate-400 text-[8px] md:text-[10px] uppercase tracking-wider mt-1" x-text="formatDate(photo.event_date)"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div x-show="paginatedPhotos.length === 0" class="text-center py-24">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-slate-500">Foto tidak ditemukan.</p>
                </div>

                <!-- Pagination Foto -->
                <div x-show="totalPhotoPages > 1" class="mt-12 flex justify-center gap-3">
                    <button @click="prevPhotoPage()" :disabled="currentPhotoPage === 1"
                            class="px-4 py-2 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 disabled:opacity-50 text-xs font-bold hover:bg-slate-100 dark:hover:bg-slate-700 transition uppercase tracking-wide text-slate-600 dark:text-slate-300">
                        Prev
                    </button>
                    <span class="flex items-center px-4 py-2 text-xs font-bold text-slate-500 uppercase tracking-wide bg-slate-50 dark:bg-slate-800/50 rounded-full border border-slate-200 dark:border-slate-800">
                        Hal <span class="text-slate-900 dark:text-white mx-1" x-text="currentPhotoPage"></span> / <span x-text="totalPhotoPages" class="ml-1"></span>
                    </span>
                    <button @click="nextPhotoPage()" :disabled="currentPhotoPage === totalPhotoPages"
                            class="px-4 py-2 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 disabled:opacity-50 text-xs font-bold hover:bg-slate-100 dark:hover:bg-slate-700 transition uppercase tracking-wide text-slate-600 dark:text-slate-300">
                        Next
                    </button>
                </div>
            </div>

            <!-- SLIDESHOW MODAL -->
            <template x-if="showSlideshow">
                <div class="fixed inset-0 z-[100] bg-black/98 backdrop-blur-xl flex items-center justify-center overflow-hidden"
                     @click.self="closeSlideshow()" x-transition.opacity>

                    <div class="absolute top-6 right-6 z-50">
                        <button @click="closeSlideshow()" class="text-white/50 hover:text-white p-2 transition-transform hover:rotate-90 rounded-full hover:bg-white/10">
                            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="absolute bottom-6 right-6 z-[150] flex gap-2">
                        <button @click="zoomOut()" class="bg-white/10 hover:bg-white/20 text-white p-3 rounded-full backdrop-blur-md transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                        </button>
                        <button @click="resetZoom()" class="bg-white/10 hover:bg-white/20 text-white px-3 rounded-full backdrop-blur-md text-xs font-bold transition-all" x-show="scale > 1">
                            RESET
                        </button>
                        <button @click="zoomIn()" class="bg-white/10 hover:bg-white/20 text-white p-3 rounded-full backdrop-blur-md transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>

                    <button @click.stop="prevSlide()" class="hidden md:flex absolute left-6 top-1/2 -translate-y-1/2 text-white/50 hover:text-white p-4 rounded-full bg-white/5 hover:bg-white/10 z-[150] transition-all hover:scale-110">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>

                    <button @click.stop="nextSlide()" class="hidden md:flex absolute right-6 top-1/2 -translate-y-1/2 text-white/50 hover:text-white p-4 rounded-full bg-white/5 hover:bg-white/10 z-[150] transition-all hover:scale-110">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                   </button>

                    <div class="relative w-full h-full flex items-center justify-center overflow-hidden"
                         @wheel.prevent="handleWheel"
                         @mousedown="startDrag"
                         @mousemove="drag"
                         @mouseup="stopDrag"
                         @mouseleave="stopDrag"
                         @touchstart="handleTouchStart"
                         @touchmove="handleTouchMove"
                         @touchend="handleTouchEnd">

                        <div class="absolute top-6 left-6 z-[140] max-w-xl transition-opacity duration-300 px-4 md:px-0" :class="{'opacity-0': scale > 1}">
                            <p class="text-white text-lg md:text-xl font-bold leading-tight drop-shadow-md" x-text="currentSlideData.caption"></p>
                            <p class="text-teal-400 text-[10px] md:text-xs font-mono uppercase tracking-wider mt-1 drop-shadow-md" x-text="formatDate(currentSlideData.event_date)"></p>
                        </div>

                        <div class="transition-transform duration-100 ease-out origin-center"
                             :style="`transform: translate(${pointX}px, ${pointY}px) scale(${scale}); cursor: ${scale > 1 ? (panning ? 'grabbing' : 'grab') : 'default'}`">
                            <img :src="getPhotoUrl(currentSlideData.image_path)"
                                 class="max-h-[85vh] md:max-h-[90vh] max-w-[95vw] md:max-w-[90vw] object-contain shadow-2xl rounded-sm select-none"
                                 draggable="false">
                        </div>
                    </div>
                </div>
            </template>

        </section>
    </div>

    <script>
        function galleryComponent() {
            return {
                view: 'albums',
                categories: @json($categories),
                activeCategory: null,

                albumSearch: '',
                selectedCategoryId: 'all',
                photoSearch: '',

                currentCatPage: 1,
                catPerPage: 6,

                currentPhotoPage: 1,
                photoPerPage: 6,

                showSlideshow: false,
                currentSlideIndex: 0,

                // ZOOM & SWIPE STATE
                scale: 1,
                panning: false,
                pointX: 0,
                pointY: 0,
                startX: 0,
                startY: 0,
                lastTouchTime: 0,
                touchStartX: 0, // For Swipe Detection

                initGallery() {
                    this.$watch('albumSearch', () => this.currentCatPage = 1);
                    this.$watch('selectedCategoryId', () => this.currentCatPage = 1);
                    this.$watch('photoSearch', () => this.currentPhotoPage = 1);
                },

                zoomIn() { this.scale = Math.min(this.scale + 0.5, 4); },
                zoomOut() { this.scale = Math.max(this.scale - 0.5, 1); if(this.scale === 1) { this.pointX = 0; this.pointY = 0; } },
                resetZoom() { this.scale = 1; this.pointX = 0; this.pointY = 0; },
                handleWheel(e) { if (e.deltaY < 0) this.zoomIn(); else this.zoomOut(); },

                startDrag(e) {
                    if (this.scale > 1) {
                        e.preventDefault();
                        this.panning = true;
                        this.startX = e.clientX - this.pointX;
                        this.startY = e.clientY - this.pointY;
                    }
                },
                drag(e) {
                    if (this.panning && this.scale > 1) {
                        e.preventDefault();
                        this.pointX = e.clientX - this.startX;
                        this.pointY = e.clientY - this.startY;
                    }
                },
                stopDrag() { this.panning = false; },

                handleTouchStart(e) {
                    const currentTime = new Date().getTime();
                    const tapLength = currentTime - this.lastTouchTime;
                    if (tapLength < 300 && tapLength > 0) {
                        if(this.scale > 1) this.resetZoom(); else this.scale = 2.5;
                        e.preventDefault();
                    }
                    this.lastTouchTime = currentTime;

                    if (e.touches.length === 1) {
                        this.touchStartX = e.touches[0].clientX;
                        if (this.scale > 1) {
                            this.panning = true;
                            this.startX = e.touches[0].clientX - this.pointX;
                            this.startY = e.touches[0].clientY - this.pointY;
                        }
                    }
                },
                handleTouchMove(e) {
                    if (this.panning && this.scale > 1 && e.touches.length === 1) {
                        e.preventDefault();
                        this.pointX = e.touches[0].clientX - this.startX;
                        this.pointY = e.touches[0].clientY - this.startY;
                    }
                },
                handleTouchEnd(e) {
                    this.panning = false;
                    if (this.scale === 1) {
                        const touchEndX = e.changedTouches[0].clientX;
                        const diffX = this.touchStartX - touchEndX;
                        if (Math.abs(diffX) > 50) {
                            if (diffX > 0) this.nextSlide();
                            else this.prevSlide();
                        }
                    }
                },

                get filteredCategories() {
                    let cats = [...this.categories];
                    if (this.albumSearch) {
                        const query = this.albumSearch.toLowerCase();
                        cats = cats.filter(cat => cat.name.toLowerCase().includes(query));
                    }
                    if (this.selectedCategoryId !== 'all') {
                        cats = cats.filter(cat => cat.id == this.selectedCategoryId);
                    }
                    cats.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                    return cats;
                },

                get paginatedCategories() {
                    const start = (this.currentCatPage - 1) * this.catPerPage;
                    return this.filteredCategories.slice(start, start + this.catPerPage);
                },
                get totalCategoryPages() { return Math.ceil(this.filteredCategories.length / this.catPerPage); },
                nextCatPage() { if (this.currentCatPage < this.totalCategoryPages) this.currentCatPage++; },
                prevCatPage() { if (this.currentCatPage > 1) this.currentCatPage--; },

                getCategoryCover(category) {
                    if (category.cover_image) return '/storage/' + category.cover_image;
                    if (category.photos && category.photos.length > 0) return '/storage/' + category.photos[0].image_path;
                    return 'https://via.placeholder.com/600x400?text=No+Image';
                },

                openCategory(category) {
                    this.activeCategory = category;
                    this.photoSearch = '';
                    this.currentPhotoPage = 1;
                    this.view = 'photos';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                closeCategory() {
                    this.view = 'albums';
                    this.activeCategory = null;
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                get filteredPhotos() {
                    if (!this.activeCategory) return [];
                    let photos = this.activeCategory.photos;
                    if (this.photoSearch) {
                        const query = this.photoSearch.toLowerCase();
                        photos = photos.filter(p => (p.caption || '').toLowerCase().includes(query));
                    }
                    return photos;
                },

                get paginatedPhotos() {
                    const start = (this.currentPhotoPage - 1) * this.photoPerPage;
                    return this.filteredPhotos.slice(start, start + this.photoPerPage);
                },

                get totalPhotoPages() { return Math.ceil(this.filteredPhotos.length / this.photoPerPage); },

                nextPhotoPage() {
                    if (this.currentPhotoPage < this.totalPhotoPages) {
                        this.currentPhotoPage++;
                        this.scrollToTop();
                    }
                },
                prevPhotoPage() {
                    if (this.currentPhotoPage > 1) {
                        this.currentPhotoPage--;
                        this.scrollToTop();
                    }
                },
                scrollToTop() {
                    const element = document.getElementById('gallery-content');
                    if (element) {
                        const top = element.getBoundingClientRect().top + window.pageYOffset - 150;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    } else {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                },

                getPhotoUrl(path) {
                    if (!path) return '';
                    return path.startsWith('http') ? path : '/storage/' + path;
                },

                openSlideshow(indexOnPage) {
                    const absoluteIndex = ((this.currentPhotoPage - 1) * this.photoPerPage) + indexOnPage;
                    this.currentSlideIndex = absoluteIndex;
                    this.showSlideshow = true;
                    this.resetZoom();
                },
                closeSlideshow() { this.showSlideshow = false; this.resetZoom(); },
                get currentSlideData() { return this.filteredPhotos[this.currentSlideIndex] || {}; },
                nextSlide() {
                    this.currentSlideIndex = (this.currentSlideIndex + 1) % this.filteredPhotos.length;
                    this.resetZoom();
                },
                prevSlide() {
                    const total = this.filteredPhotos.length;
                    this.currentSlideIndex = (this.currentSlideIndex - 1 + total) % total;
                    this.resetZoom();
                },

                handleEscape() {
                    if (this.showSlideshow) this.closeSlideshow();
                    else if (this.view === 'photos') this.closeCategory();
                },
                formatDate(dateString) {
                    if(!dateString) return '';
                    return new Date(dateString).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
                }
            }
        }
    </script>
</x-app-layout>
