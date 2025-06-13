<x-app-layout>
    <!-- Gallery Header -->
    <section class="bg-bone py-8 px-6">
        <div class="max-w-screen-xl mx-auto text-center">
            <h1 class="text-4xl font-playfair font-bold text-gray-800 mb-4">Photo Gallery</h1>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Explore our memories and experiences through these captured moments.</p>
        </div>
    </section>

    <!-- Gallery Content -->
    <section class="py-12 px-6" 
        x-data="{ 
            view: 'categories',
            selectedCategory: null,
            selectedPhoto: null,
            showSlideshow: false,

            init() {
                this.$watch('showSlideshow', value => {
                    document.body.style.overflow = value ? 'hidden' : 'auto';
                });
            },

            showCategories() {
                this.view = 'categories';
                this.selectedCategory = null;
                this.selectedPhoto = null;
            },

            showAlbum(category) {
                this.selectedCategory = category;
                this.view = 'album';
            },

            openSlideshow(category, photoIndex) {
                this.selectedCategory = category;
                this.selectedPhoto = photoIndex;
                this.showSlideshow = true;
            },

            closeSlideshow() {
                this.showSlideshow = false;
                this.selectedPhoto = null;
            },

            nextPhoto() {
                const photos = this.$refs[`photos-${this.selectedCategory}`].children;
                this.selectedPhoto = (this.selectedPhoto + 1) % photos.length;
            },

            prevPhoto() {
                const photos = this.$refs[`photos-${this.selectedCategory}`].children;
                this.selectedPhoto = (this.selectedPhoto - 1 + photos.length) % photos.length;
            }
        }"
        @keydown.escape="showSlideshow && closeSlideshow()"
        @keydown.right="showSlideshow && nextPhoto()"
        @keydown.left="showSlideshow && prevPhoto()">

        <div class="max-w-screen-xl mx-auto">
            <!-- Categories Grid -->
            <div x-show="view === 'categories'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow cursor-pointer"
                         @click="showAlbum('{{ $category->id }}')">
                        <div class="relative aspect-video">
                            <img src="{{ asset('storage/' . $category->cover_image) }}" 
                                 alt="{{ $category->name }}" 
                                 class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <h2 class="text-white text-xl font-bold mb-2">{{ $category->name }}</h2>
                                <p class="text-white/80 text-sm">{{ count($category->photos) }} photos</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Album Photos Grid View -->
            @foreach($categories as $category)
                <div x-show="selectedCategory === '{{ $category->id }}' && view === 'album'" x-cloak>
                    <div class="flex items-center justify-between mb-8">
                        <button @click="showCategories()" class="flex items-center text-gray-600 hover:text-gray-800">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Albums
                        </button>
                        <h2 class="text-2xl font-playfair font-bold text-gray-800">{{ $category->name }}</h2>
                        <div class="w-24"></div> <!-- Spacer for centering -->
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($category->photos as $index => $photo)
                            <div class="aspect-square overflow-hidden rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                                 @click="openSlideshow('{{ $category->id }}', {{ $index }})">
                                <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                     alt="{{ $photo->caption }}" 
                                     class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Slideshow Modal -->
                <template x-if="showSlideshow && selectedCategory === '{{ $category->id }}'">
                    <div class="fixed inset-0 z-50 bg-black/90">
                        <div class="relative z-10 h-full flex items-center justify-center">
                            <button class="absolute top-4 right-4 text-white text-xl p-2" @click="closeSlideshow()">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            
                            <button class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white p-2" @click="prevPhoto()">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            
                            <button class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white p-2" @click="nextPhoto()">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>

                            <div class="w-full max-w-4xl px-4" x-ref="photos-{{ $category->id }}">
                                @foreach($category->photos as $index => $photo)
                                    <div x-show="selectedPhoto === {{ $index }}"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0 transform scale-95"
                                         x-transition:enter-end="opacity-100 transform scale-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100 transform scale-100"
                                         x-transition:leave-end="opacity-0 transform scale-95">
                                        <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                             alt="{{ $photo->caption }}" 
                                             class="max-h-[80vh] mx-auto">
                                        @if($photo->caption || $photo->event_date)
                                            <div class="text-center mt-4 text-white">
                                                @if($photo->caption)
                                                    <p class="text-lg">{{ $photo->caption }}</p>
                                                @endif
                                                @if($photo->event_date)
                                                    <p class="text-sm text-gray-300">{{ $photo->event_date->format('F j, Y') }}</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </template>
            @endforeach
        </div>
    </section>

    @push('styles')
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @endpush
</x-app-layout> 