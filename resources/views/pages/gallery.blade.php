<x-app-layout>
    <!-- Wrapper Utama: Adaptif Light/Dark -->
    <div class="min-h-screen bg-slate-50 dark:bg-[#020617] text-slate-900 dark:text-white selection:bg-teal-500 selection:text-white font-sans overflow-x-hidden transition-colors duration-300">

        <!-- HEADER SECTION -->
        <section class="relative pt-40 pb-12 px-6 overflow-hidden text-center">
            <!-- Efek Glow Halus di Background -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
                <div class="absolute top-10 left-1/4 w-[500px] h-[500px] bg-teal-500/10 dark:bg-teal-900/20 rounded-full blur-[120px] opacity-50"></div>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto">
                <!-- Badge "OUR MEMORIES" -->
                <span class="inline-block py-2 px-5 rounded-full bg-white dark:bg-[#0F172A] border border-slate-200 dark:border-slate-800 text-teal-600 dark:text-teal-400 text-[11px] font-bold tracking-[0.2em] uppercase mb-8 shadow-lg">
                    Our Memories
                </span>

                <!-- Title "Visual Diaries." -->
                <h1 class="text-6xl md:text-8xl font-bold text-slate-900 dark:text-white mb-6 tracking-tighter leading-none">
                    Visual <span class="text-teal-500">Diaries.</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl mx-auto leading-relaxed font-light">
                    Moments frozen in time. Filter by category and explore our journey page by page.
                </p>
            </div>
        </section>

        <!-- GALLERY CONTENT -->
        <section class="pb-32 px-4"
            x-data="galleryComponent()"
            x-init="initGallery()"
            @keydown.escape.window="closeSlideshow()"
            @keydown.right.window="showSlideshow ? nextSlide() : nextPage()"
            @keydown.left.window="showSlideshow ? prevSlide() : prevPage()">

            <!-- 1. NAVIGATION PILLS (Adaptive) -->
            <div class="sticky top-24 z-30 mb-16 flex flex-col items-center">

                <!-- Scrollable Container -->
                <div class="w-full max-w-4xl overflow-x-auto no-scrollbar py-4">
                    <div class="flex justify-center gap-3 min-w-max px-4">
                        <template x-for="category in categories" :key="category.id">
                            <button @click="setCategory(category.id)"
                                    class="group relative flex items-center gap-3 px-6 py-3 rounded-full text-sm font-bold tracking-wide transition-all duration-300 border"
                                    :class="activeCategory === category.id
                                        ? 'bg-slate-900 dark:bg-white text-white dark:text-slate-900 border-slate-900 dark:border-white shadow-xl scale-105'
                                        : 'bg-white dark:bg-[#0F172A]/50 text-slate-500 dark:text-slate-400 border-slate-200 dark:border-slate-800 hover:border-slate-400 dark:hover:border-slate-600 hover:text-slate-900 dark:hover:text-white'">

                                <!-- Nama Kategori -->
                                <span x-text="category.name"></span>

                                <!-- Counter Badge -->
                                <span x-text="category.photos.length"
                                      class="flex items-center justify-center h-5 min-w-[20px] px-1.5 text-[10px] rounded transition-colors"
                                      :class="activeCategory === category.id
                                        ? 'bg-white/20 text-white dark:text-slate-900 dark:bg-black/10'
                                        : 'bg-slate-100 dark:bg-slate-800 text-slate-500 group-hover:bg-slate-200 dark:group-hover:bg-slate-700'">
                                </span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Info Pill -->
                <div class="mt-4" x-show="paginatedPhotos.length > 0" key="info">
                    <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white dark:bg-[#0F172A] border border-slate-200 dark:border-slate-800 shadow-lg">
                        <div class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></div>
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-[0.15em]">
                            Showing <span class="text-slate-900 dark:text-white" x-text="paginationStart"></span> - <span class="text-slate-900 dark:text-white" x-text="paginationEnd"></span>
                            of <span class="text-slate-900 dark:text-white" x-text="currentCategoryPhotos.length"></span> Photos
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. PHOTOS GRID -->
            <div id="gallery-grid" class="max-w-screen-xl mx-auto min-h-[600px]">

                <!-- Grid Layout -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
                     x-show="paginatedPhotos.length > 0"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">

                    <template x-for="(photo, index) in paginatedPhotos" :key="photo.id">
                        <div class="group relative w-full aspect-[4/3] rounded-2xl overflow-hidden cursor-pointer bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-teal-500/50 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-teal-900/20"
                             @click="openSlideshow(index)">

                            <!-- Image -->
                            <img :src="photo.image_path.startsWith('http') ? photo.image_path : '/storage/' + photo.image_path"
                                 loading="lazy"
                                 :alt="photo.caption"
                                 class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            <!-- Caption on Hover (Desktop Only) -->
                            <div class="hidden md:block absolute bottom-0 left-0 w-full p-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-300 opacity-0 group-hover:opacity-100">
                                <p class="text-white font-bold text-lg truncate" x-text="photo.caption || 'No Caption'"></p>
                                <p class="text-teal-400 text-xs font-mono mt-1" x-text="formatDate(photo.event_date)"></p>
                            </div>

                            <!-- Caption Mobile (Icon) -->
                             <div class="md:hidden absolute bottom-3 right-3 bg-black/40 backdrop-blur-sm p-1.5 rounded-lg border border-white/10">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Empty State -->
                <div x-show="paginatedPhotos.length === 0" class="col-span-full flex flex-col items-center justify-center py-32 opacity-50">
                    <div class="w-20 h-20 rounded-full bg-slate-100 dark:bg-slate-900 mb-6 flex items-center justify-center border border-slate-200 dark:border-slate-800">
                        <svg class="w-10 h-10 text-slate-400 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Empty Album</h3>
                    <p class="text-slate-500 mt-2">No memories captured here yet.</p>
                </div>

                <!-- 3. PAGINATION CONTROLS -->
                <div x-show="totalPages > 1" class="mt-24 pb-10">
                    <div class="flex justify-center items-center gap-4">
                        <button @click="prevPage()"
                                :disabled="currentPage === 1"
                                :class="currentPage === 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-slate-900 dark:hover:bg-white hover:text-white dark:hover:text-black hover:scale-110'"
                                class="group flex items-center justify-center w-12 h-12 rounded-full border border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 transition-all duration-300 bg-white dark:bg-[#0F172A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>

                        <div class="flex gap-2 items-center bg-white dark:bg-[#0F172A] px-4 py-2 rounded-full border border-slate-200 dark:border-slate-800">
                            <template x-for="page in totalPages" :key="page">
                                <button @click="goToPage(page)"
                                        :class="currentPage === page
                                            ? 'bg-teal-500 text-white shadow-lg'
                                            : 'text-slate-500 hover:text-slate-900 dark:hover:text-white'"
                                        class="w-8 h-8 rounded-full text-xs font-bold transition-all duration-300 flex items-center justify-center"
                                        x-text="page">
                                </button>
                            </template>
                        </div>

                        <button @click="nextPage()"
                                :disabled="currentPage === totalPages"
                                :class="currentPage === totalPages ? 'opacity-30 cursor-not-allowed' : 'hover:bg-slate-900 dark:hover:bg-white hover:text-white dark:hover:text-black hover:scale-110'"
                                class="group flex items-center justify-center w-12 h-12 rounded-full border border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 transition-all duration-300 bg-white dark:bg-[#0F172A]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. SLIDESHOW MODAL (Swipe & Zoom Enabled) -->
            <template x-if="showSlideshow">
                <div class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-xl flex items-center justify-center overflow-hidden touch-none"
                     @click.self="closeSlideshow()"
                     x-transition.opacity>

                    <!-- Toolbar -->
                    <div class="absolute top-0 left-0 w-full p-4 md:p-6 flex justify-between items-center z-50 pointer-events-none">
                        <span class="text-white/80 text-xs md:text-sm font-bold tracking-widest font-mono bg-black/40 px-3 py-1 rounded-full backdrop-blur-sm">
                            <span x-text="paginationStart + selectedPhotoIndex"></span> / <span x-text="currentCategoryPhotos.length"></span>
                        </span>
                        <div class="flex items-center gap-3 md:gap-4 pointer-events-auto">
                            <button @click="toggleZoom()" class="text-white/70 hover:text-white transition-colors p-2 md:p-3 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm">
                                <svg x-show="!isZoomed" class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                <svg x-show="isZoomed" class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path></svg>
                            </button>
                            <button @click="closeSlideshow()" class="text-white/70 hover:text-white transition-colors p-2 md:p-3 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm">
                                <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Main Image Area -->
                    <div class="relative w-full h-full flex items-center justify-center"
                         @touchstart="startTouch"
                         @touchmove="moveTouch"
                         @touchend="endTouch"
                         @mousedown="startDrag"
                         @mousemove="onDrag"
                         @mouseup="endDrag"
                         @mouseleave="endDrag">

                        <!-- Left Arrow (Desktop) -->
                        <button x-show="!isZoomed" @click.stop="prevSlide()" class="absolute left-2 md:left-8 text-white/50 hover:text-white hover:scale-110 transition-all p-3 md:p-4 bg-white/5 hover:bg-white/10 rounded-full backdrop-blur-sm z-40 hidden md:block">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>

                        <!-- Image Wrapper -->
                        <div class="relative w-full h-full flex items-center justify-center transition-transform duration-300 ease-out"
                             :style="`transform: scale(${scale}) translate(${translateX}px, ${translateY}px); cursor: ${isZoomed ? 'grab' : 'default'}`"
                             :class="{ 'cursor-grabbing': isDragging, 'transition-none': isDragging }">

                            <img :src="currentSlideData.image_path && currentSlideData.image_path.startsWith('http') ? currentSlideData.image_path : '/storage/' + currentSlideData.image_path"
                                 class="max-w-full max-h-full object-contain transition-opacity duration-300 select-none pointer-events-none"
                                 alt="Gallery Photo">
                        </div>

                        <!-- Right Arrow (Desktop) -->
                        <button x-show="!isZoomed" @click.stop="nextSlide()" class="absolute right-2 md:right-8 text-white/50 hover:text-white hover:scale-110 transition-all p-4 bg-white/5 hover:bg-white/10 rounded-full backdrop-blur-sm z-40 hidden md:block">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>

                        <!-- Caption (Fixed Visibility) -->
                        <div x-show="!isZoomed"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute bottom-10 left-0 w-full text-center pointer-events-none z-50 px-4">
                            <div class="inline-block bg-black/60 backdrop-blur-xl px-6 py-4 rounded-2xl border border-white/10 shadow-2xl max-w-md">
                                <p class="text-white text-lg font-bold" x-text="currentSlideData.caption || 'No Caption'"></p>
                                <p class="text-teal-400 text-xs font-mono mt-1 uppercase tracking-wider" x-show="currentSlideData.event_date" x-text="formatDate(currentSlideData.event_date)"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

        </section>
    </div>

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

                // Zoom & Pan & Swipe State
                scale: 1,
                translateX: 0,
                translateY: 0,
                isDragging: false,
                startX: 0,
                startY: 0,
                lastTouchTime: 0,

                get isZoomed() { return this.scale > 1; },

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
                        window.scrollTo({top: grid.offsetTop - 200, behavior: 'smooth'});
                    }
                },
                get currentCategoryPhotos() { return this.categories.find(c => c.id === this.activeCategory)?.photos || []; },
                get totalPages() { return Math.ceil(this.currentCategoryPhotos.length / this.perPage); },
                get paginatedPhotos() {
                    const start = (this.currentPage - 1) * this.perPage;
                    return this.currentCategoryPhotos.slice(start, start + this.perPage);
                },
                get paginationStart() { return ((this.currentPage - 1) * this.perPage) + 1; },
                get paginationEnd() {
                    const end = this.currentPage * this.perPage;
                    return end > this.currentCategoryPhotos.length ? this.currentCategoryPhotos.length : end;
                },
                goToPage(page) { this.currentPage = page; this.scrollToGrid(); },
                nextPage() { if (this.currentPage < this.totalPages) this.goToPage(this.currentPage + 1); },
                prevPage() { if (this.currentPage > 1) this.goToPage(this.currentPage - 1); },
                scrollToGrid() {
                    const grid = document.getElementById('gallery-grid');
                    if(grid) window.scrollTo({top: grid.offsetTop - 200, behavior: 'smooth'});
                },

                openSlideshow(indexOnPage) {
                    this.currentSlideIndex = ((this.currentPage - 1) * this.perPage) + indexOnPage;
                    this.showSlideshow = true;
                    this.resetZoom();
                },
                closeSlideshow() { this.showSlideshow = false; this.resetZoom(); },
                toggleZoom() { this.scale = this.scale > 1 ? 1 : 2.5; if(this.scale===1) this.resetZoom(); },
                resetZoom() { this.scale = 1; this.translateX = 0; this.translateY = 0; },
                nextSlide() { this.currentSlideIndex = (this.currentSlideIndex + 1) % this.currentCategoryPhotos.length; this.resetZoom(); },
                prevSlide() {
                    const total = this.currentCategoryPhotos.length;
                    this.currentSlideIndex = (this.currentSlideIndex - 1 + total) % total;
                    this.resetZoom();
                },
                get currentSlideData() { return this.currentCategoryPhotos[this.currentSlideIndex] || {}; },

                // TOUCH HANDLERS (Mobile Swipe)
                startTouch(e) {
                    const currentTime = new Date().getTime();
                    const tapLength = currentTime - this.lastTouchTime;
                    if (tapLength < 300 && tapLength > 0) { this.toggleZoom(); e.preventDefault(); return; }
                    this.lastTouchTime = currentTime;

                    if (e.touches.length === 1) {
                        this.startX = e.touches[0].clientX;
                        this.startY = e.touches[0].clientY;
                        this.isDragging = true;
                    }
                },
                moveTouch(e) {
                    if (!this.isDragging) return;
                    const x = e.touches[0].clientX;
                    const y = e.touches[0].clientY;

                    if (this.isZoomed) {
                        e.preventDefault();
                        this.translateX += x - this.startX;
                        this.translateY += y - this.startY;
                        this.startX = x;
                        this.startY = y;
                    }
                },
                endTouch(e) {
                    if (!this.isDragging) return;
                    this.isDragging = false;

                    if (!this.isZoomed) {
                        const endX = e.changedTouches[0].clientX;
                        const diffX = this.startX - endX;
                        if (Math.abs(diffX) > 50) {
                            if (diffX > 0) this.nextSlide();
                            else this.prevSlide();
                        }
                    }
                },

                // MOUSE HANDLERS (Desktop)
                startDrag(e) {
                    if (!this.isZoomed) return;
                    e.preventDefault();
                    this.isDragging = true;
                    this.startX = e.clientX;
                    this.startY = e.clientY;
                },
                onDrag(e) {
                    if (!this.isDragging || !this.isZoomed) return;
                    e.preventDefault();
                    this.translateX += e.clientX - this.startX;
                    this.translateY += e.clientY - this.startY;
                    this.startX = e.clientX;
                    this.startY = e.clientY;
                },
                endDrag() { this.isDragging = false; },

                formatDate(dateString) {
                    if(!dateString) return '';
                    return new Date(dateString).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                }
            }
        }
    </script>
</x-app-layout>
