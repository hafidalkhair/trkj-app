<x-app-layout>
    <!-- Header Section -->
    <section class="relative pt-40 pb-12 px-6 bg-slate-50 dark:bg-slate-950 overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-30 pointer-events-none">
            <div class="absolute top-20 left-20 w-72 h-72 bg-teal-500/20 rounded-full blur-3xl mix-blend-multiply animate-blob"></div>
            <div class="absolute top-20 right-20 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl mix-blend-multiply animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto text-center">
            <span class="inline-block py-2 px-4 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-xs font-bold mb-6 tracking-widest uppercase animate__animated animate__fadeInDown">
                Our Memories
            </span>
            <h1 class="text-5xl md:text-7xl font-bold text-slate-900 dark:text-white mb-6 tracking-tight animate__animated animate__fadeInUp animate__delay-1s">
                Visual <span class="text-teal-600">Diaries.</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed animate__animated animate__fadeInUp animate__delay-2s">
                Moments frozen in time. Filter by category and explore our journey page by page.
            </p>
        </div>
    </section>

    <!-- Main Gallery Interface -->
    <section class="pb-32 min-h-screen bg-slate-50 dark:bg-slate-950"
        x-data="galleryComponent()"
        x-init="initGallery()"
        @keydown.escape.window="closeSlideshow()"
        @keydown.right.window="showSlideshow ? nextSlide() : nextPage()"
        @keydown.left.window="showSlideshow ? prevSlide() : prevPage()">

        <!-- 1. ULTRA MODERN FLOATING NAVIGATION (THE UPGRADE) -->
        <div class="sticky top-24 z-30 mb-12 px-4 transition-all duration-300">
            <div class="flex flex-col items-center">

                <!-- Glass Dock Container -->
                <div class="relative max-w-[95vw] md:max-w-3xl mx-auto">

                    <!-- Fade Gradients (Petunjuk Visual Scroll) -->
                    <div class="absolute left-0 top-0 bottom-0 w-12 bg-gradient-to-r from-slate-50/90 dark:from-slate-950/90 to-transparent z-20 pointer-events-none rounded-l-full"></div>
                    <div class="absolute right-0 top-0 bottom-0 w-12 bg-gradient-to-l from-slate-50/90 dark:from-slate-950/90 to-transparent z-20 pointer-events-none rounded-r-full"></div>

                    <!-- The Dock Itself -->
                    <div class="bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border border-white/40 dark:border-slate-700/50 p-1.5 rounded-full shadow-2xl shadow-slate-200/50 dark:shadow-black/50 ring-1 ring-black/5 dark:ring-white/5 overflow-hidden">

                        <!-- Scrollable Items -->
                        <div class="flex space-x-1 overflow-x-auto no-scrollbar items-center scroll-smooth px-2" x-ref="navContainer">
                            <template x-for="category in categories" :key="category.id">
                                <button @click="setCategory(category.id)"
                                        x-effect="if(activeCategory === category.id) $el.scrollIntoView({behavior: 'smooth', block: 'nearest', inline: 'center'})"
                                        :class="activeCategory === category.id
                                            ? 'bg-slate-900 dark:bg-white text-white dark:text-slate-900 shadow-md scale-100 font-bold'
                                            : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 font-medium'"
                                        class="relative flex-shrink-0 px-5 py-2.5 rounded-full text-sm tracking-wide transition-all duration-300 flex items-center gap-2 whitespace-nowrap select-none group">

                                    <!-- Category Name -->
                                    <span x-text="category.name"></span>

                                    <!-- Minimalist Counter -->
                                    <span x-text="category.photos.length"
                                          :class="activeCategory === category.id
                                            ? 'bg-white/20 text-white dark:text-slate-900'
                                            : 'bg-slate-200 dark:bg-slate-700 text-slate-500 dark:text-slate-400 group-hover:bg-slate-300 dark:group-hover:bg-slate-600'"
                                          class="px-1.5 py-0.5 rounded-md text-[10px] font-mono transition-colors">
                                    </span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Elegant Info Bar (Showing X - Y of Z) -->
                <div class="mt-4 animate__animated animate__fadeIn" x-show="paginatedPhotos.length > 0" key="info">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></div>
                        <p class="text-[10px] md:text-xs text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest">
                            Showing <span class="text-slate-900 dark:text-white" x-text="paginationStart"></span> - <span class="text-slate-900 dark:text-white" x-text="paginationEnd"></span>
                            of <span class="text-slate-900 dark:text-white" x-text="currentCategoryPhotos.length"></span>
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- 2. PHOTOS GRID -->
        <div id="gallery-grid" class="max-w-screen-xl mx-auto px-6 min-h-[600px]">

            <!-- Grid Container -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6"
                 x-show="paginatedPhotos.length > 0"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-y-12 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100">

                <template x-for="(photo, index) in paginatedPhotos" :key="photo.id">
                    <div class="group relative w-full aspect-[4/3] rounded-2xl md:rounded-3xl overflow-hidden cursor-zoom-in bg-slate-200 dark:bg-slate-800 shadow-sm hover:shadow-2xl hover:shadow-teal-900/20 transition-all duration-500 hover:-translate-y-2"
                         @click="openSlideshow(index)">

                        <!-- Image -->
                        <!-- Perhatikan bagian src: Menambahkan /storage/ di depan path database -->
                        <img :src="'/storage/' + photo.image_path"
                             loading="lazy"
                             :alt="photo.caption"
                             class="w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-1000 ease-out">

                        <!-- Premium Overlay Effect -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Icon -->
                        <div class="absolute bottom-4 right-4 bg-white/10 backdrop-blur-md border border-white/20 p-2.5 rounded-full opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 delay-100">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Empty State -->
            <div x-show="paginatedPhotos.length === 0" class="col-span-full flex flex-col items-center justify-center py-32 opacity-50">
                <div class="w-20 h-20 rounded-full bg-slate-100 dark:bg-slate-800 mb-6 flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Empty Album</h3>
                <p class="text-slate-500 mt-2">No memories captured here yet.</p>
            </div>

            <!-- 3. PREMIUM PAGINATION CONTROLS -->
            <div x-show="totalPages > 1" class="mt-24 pb-10">
                <div class="flex justify-center items-center gap-6 animate__animated animate__fadeInUp">
                    <!-- Prev Button -->
                    <button @click="prevPage()"
                            :disabled="currentPage === 1"
                            :class="currentPage === 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-white hover:text-slate-900 hover:scale-110 hover:shadow-xl'"
                            class="group flex items-center justify-center w-14 h-14 rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 dark:text-slate-500 transition-all duration-300 bg-transparent backdrop-blur-sm">
                        <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>

                    <!-- Page Indicators (Dots Style) -->
                    <div class="flex gap-3 items-center bg-white/50 dark:bg-slate-800/50 px-6 py-3 rounded-full shadow-lg border border-slate-100 dark:border-slate-700 backdrop-blur-md">
                        <template x-for="page in totalPages" :key="page">
                            <button @click="goToPage(page)"
                                    :class="currentPage === page
                                        ? 'w-8 h-2.5 bg-slate-900 dark:bg-white rounded-full shadow-md'
                                        : 'w-2.5 h-2.5 bg-slate-300 dark:bg-slate-600 rounded-full hover:bg-teal-500 hover:scale-125'"
                                    class="transition-all duration-300"
                                    :title="'Go to page ' + page">
                            </button>
                        </template>
                    </div>

                    <!-- Next Button -->
                    <button @click="nextPage()"
                            :disabled="currentPage === totalPages"
                            :class="currentPage === totalPages ? 'opacity-30 cursor-not-allowed' : 'hover:bg-white hover:text-slate-900 hover:scale-110 hover:shadow-xl'"
                            class="group flex items-center justify-center w-14 h-14 rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 dark:text-slate-500 transition-all duration-300 bg-transparent backdrop-blur-sm">
                        <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- 4. GLOBAL SLIDESHOW MODAL -->
        <template x-if="showSlideshow">
            <div class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-xl flex items-center justify-center"
                 @click.self="closeSlideshow()"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">

                <!-- Toolbar -->
                <div class="absolute top-0 left-0 w-full p-6 flex justify-between items-center z-50 bg-gradient-to-b from-black/60 to-transparent">
                    <span class="text-white/80 text-sm font-bold tracking-widest font-mono">
                        <span x-text="paginationStart + selectedPhotoIndex"></span> / <span x-text="currentCategoryPhotos.length"></span>
                    </span>
                    <div class="flex items-center gap-4">
                        <button @click="toggleZoom()" class="text-white/70 hover:text-white transition-colors p-2 rounded-full hover:bg-white/10" title="Zoom">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                        </button>
                        <button @click="closeSlideshow()" class="text-white/70 hover:text-white transition-colors p-2 rounded-full hover:bg-white/10">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Main Image Area -->
                <div class="relative w-full h-full flex items-center justify-center px-4 md:px-16 py-12">
                    <button class="absolute left-4 md:left-8 text-white/50 hover:text-white hover:scale-110 transition-all p-3 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm z-50"
                            @click.stop="prevSlide()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>

                    <div class="flex flex-col items-center justify-center w-full h-full transition-all duration-300"
                         :class="{ 'scale-100': zoomLevel === 1, 'scale-[2.5] cursor-move': zoomLevel > 1 }">

                        <!-- Image di Slideshow -->
                        <img :src="'/storage/' + currentSlideData.image_path"
                             class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl transition-transform duration-300"
                             @click="toggleZoom()"
                             alt="Gallery Photo">

                        <div class="mt-6 text-center max-w-2xl transition-opacity duration-300"
                             :class="{ 'opacity-0': zoomLevel > 1, 'opacity-100': zoomLevel === 1 }">
                            <p class="text-white text-lg font-medium" x-text="currentSlideData.caption"></p>
                            <p class="text-teal-400 text-sm mt-1 font-medium" x-show="currentSlideData.event_date" x-text="formatDate(currentSlideData.event_date)"></p>
                        </div>
                    </div>

                    <button class="absolute right-4 md:right-8 text-white/50 hover:text-white hover:scale-110 transition-all p-3 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm z-50"
                            @click.stop="nextSlide()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </template>

    </section>

    <!-- ALPINE JS LOGIC -->
    <script>
        function galleryComponent() {
            return {

                categories: @json($categories->load('photos')),

                activeCategory: null,
                currentPage: 1,
                perPage: 12,
                showSlideshow: false,
                currentSlideIndex: 0,
                zoomLevel: 1,

                initGallery() {
                    if (this.categories.length > 0) {
                        this.activeCategory = this.categories[0].id;
                    }
                },

                setCategory(id) {
                    this.activeCategory = id;
                    this.currentPage = 1;

                    const grid = document.getElementById('gallery-grid');
                    if(grid && window.scrollY > grid.offsetTop) {
                        const yOffset = -250;
                        const y = grid.getBoundingClientRect().top + window.pageYOffset + yOffset;
                        window.scrollTo({top: y, behavior: 'smooth'});
                    }
                },

                get currentCategoryPhotos() {
                    const category = this.categories.find(c => c.id === this.activeCategory);
                    return category ? category.photos : [];
                },

                get totalPages() {
                    return Math.ceil(this.currentCategoryPhotos.length / this.perPage);
                },

                get paginatedPhotos() {
                    const start = (this.currentPage - 1) * this.perPage;
                    const end = start + this.perPage;
                    return this.currentCategoryPhotos.slice(start, end);
                },

                get paginationStart() {
                    return ((this.currentPage - 1) * this.perPage) + 1;
                },

                get paginationEnd() {
                    const end = this.currentPage * this.perPage;
                    return end > this.currentCategoryPhotos.length ? this.currentCategoryPhotos.length : end;
                },

                goToPage(page) {
                    this.currentPage = page;
                    const grid = document.getElementById('gallery-grid');
                    if(grid) {
                        const yOffset = -200;
                        const y = grid.getBoundingClientRect().top + window.pageYOffset + yOffset;
                        window.scrollTo({top: y, behavior: 'smooth'});
                    }
                },

                nextPage() {
                    if (this.currentPage < this.totalPages) this.goToPage(this.currentPage + 1);
                },

                prevPage() {
                    if (this.currentPage > 1) this.goToPage(this.currentPage - 1);
                },

                openSlideshow(indexOnPage) {
                    const globalIndex = ((this.currentPage - 1) * this.perPage) + indexOnPage;
                    this.currentSlideIndex = globalIndex;
                    this.showSlideshow = true;
                    this.zoomLevel = 1;
                },

                closeSlideshow() {
                    this.showSlideshow = false;
                },

                toggleZoom() {
                    this.zoomLevel = this.zoomLevel === 1 ? 2.5 : 1;
                },

                nextSlide() {
                    this.currentSlideIndex = (this.currentSlideIndex + 1) % this.currentCategoryPhotos.length;
                    this.zoomLevel = 1;
                },

                prevSlide() {
                    const total = this.currentCategoryPhotos.length;
                    this.currentSlideIndex = (this.currentSlideIndex - 1 + total) % total;
                    this.zoomLevel = 1;
                },

                get currentSlideData() {
                    return this.currentCategoryPhotos[this.currentSlideIndex] || {};
                },

                formatDate(dateString) {
                    if(!dateString) return '';
                    return new Date(dateString).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                }
            }
        }
    </script>
</x-app-layout>
