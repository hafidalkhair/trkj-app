<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-bone" x-data="{ currentSlide: 0 }" x-init="setInterval(() => { currentSlide = (currentSlide + 1) % $refs.slides.children.length }, 5000)">
        <div class="mx-auto">
            <!-- Image Slider with Overlay -->
            <div class="relative h-[400px] md:h-[600px] lg:h-[700px] overflow-hidden" x-ref="slides">
                @foreach($latestPhotos->flatMap->photos as $photo)
                    <a href="{{ route('gallery') }}" class="block h-full">
                        <div x-show="currentSlide === {{ $loop->index }}"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute inset-0">
                            <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                 alt="{{ $photo->caption }}" 
                                 class="w-full h-full object-cover">
                            @if($photo->caption)
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent text-white p-4">
                                    <p class="text-sm md:text-base">{{ $photo->caption }}</p>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
                
                <!-- Content Overlay -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/60 flex items-center justify-center">
                    <div class="text-center text-white px-4 md:px-6 max-w-screen-xl mx-auto w-full">
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-playfair font-bold mb-4 md:mb-6">Welcome to Our Class Portfolio</h1>
                        <p class="text-base md:text-lg lg:text-xl mb-6 md:mb-8 max-w-xl md:max-w-2xl mx-auto leading-relaxed">
                            Discover our journey, achievements, and memories through this digital showcase of our class activities and accomplishments.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                            <a href="{{ route('gallery') }}" class="w-full sm:w-auto bg-tan hover:bg-tan/90 text-white font-medium py-2.5 md:py-3 px-4 md:px-6 rounded-lg transition-colors text-sm md:text-base">
                                View Gallery
                            </a>
                            <a href="{{ route('contact') }}" class="w-full sm:w-auto bg-white hover:bg-gray-50 text-gray-800 font-medium py-2.5 md:py-3 px-4 md:px-6 rounded-lg transition-colors text-sm md:text-base">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation Buttons - Hidden on mobile -->
                <div class="hidden md:block">
                    <button @click.stop="currentSlide = (currentSlide - 1 + $refs.slides.children.length) % $refs.slides.children.length" 
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition-colors z-20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button @click.stop="currentSlide = (currentSlide + 1) % $refs.slides.children.length" 
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 transition-colors z-20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Dots Navigation -->
                <div class="absolute bottom-20 sm:bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
                    @foreach($latestPhotos->flatMap->photos as $photo)
                        <button @click.stop="currentSlide = {{ $loop->index }}"
                                :class="{'bg-white': currentSlide === {{ $loop->index }}, 'bg-white/50': currentSlide !== {{ $loop->index }}}"
                                class="w-2 h-2 md:w-3 md:h-3 rounded-full transition-colors"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 px-6">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl font-playfair font-bold text-gray-800 mb-8 text-center">About Us</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="text-gray-700 mb-6">Our class is more than just a group of students; we are a family that supports and inspires each other. Together, we strive for excellence in our academic pursuits while creating lasting memories and friendships.</p>
                    <p class="text-gray-700">We believe in the power of collaboration, creativity, and continuous learning. Our diverse talents and shared commitment to growth make our class unique and special.</p>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($members as $member)
                        <div class="bg-bone rounded-lg p-4 text-center">
                            <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}" alt="{{ $member->full_name }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                            <h3 class="font-medium text-gray-800">{{ $member->full_name }}</h3>
                            <p class="text-sm text-gray-600 capitalize">{{ $member->position }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Photos Section -->
    <section class="py-16 px-6 bg-bone/30">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl font-playfair font-bold text-gray-800 mb-8 text-center">Latest Activities</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($latestPhotos as $category)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('storage/' . $category->cover_image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-playfair font-bold text-xl text-gray-800 mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($category->description, 100) }}</p>
                            <a href="{{ route('gallery') }}" class="text-tan hover:text-tan/80 font-medium">View Photos →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-16 px-6">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl font-playfair font-bold text-gray-800 mb-8 text-center">Our Journey</h2>
            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-tan"></div>
                
                <!-- Timeline items -->
                <div class="space-y-12">
                    <!-- Item 1 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-tan w-4 h-4 rounded-full"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-800">First Semester Begins</h3>
                            <p class="text-gray-600">September 2023</p>
                            <p class="mt-2 text-gray-700">Botak Era</p>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-tan w-4 h-4 rounded-full"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-800">Semester II</h3>
                            <p class="text-gray-600">Maret 2024</p>
                            <p class="mt-2 text-gray-700">Tiba-tiba Aja</p>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-tan w-4 h-4 rounded-full"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-800">Semester III</h3>
                            <p class="text-gray-600">September 2024</p>
                            <p class="mt-2 text-gray-700">Masa Sulit</p>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-tan w-4 h-4 rounded-full"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-800">Semester IV</h3>
                            <p class="text-gray-600">Maret 2023</p>
                            <p class="mt-2 text-gray-700">Real Terjadi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout> 