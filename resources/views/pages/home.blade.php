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
                            <a href="{{ route('gallery') }}" class="w-full sm:w-auto bg-primary hover:bg-primary-light text-white font-medium py-2.5 md:py-3 px-6 md:px-8 rounded-lg transition-colors">
                                View Gallery
                            </a>
                            <a href="{{ route('contact') }}" class="w-full sm:w-auto bg-white hover:bg-neutral-50 text-neutral-800 font-medium py-2.5 md:py-3 px-6 md:px-8 rounded-lg transition-colors">
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
    <section class="py-16 px-6 bg-subtle-gradient">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl font-playfair font-bold text-neutral-800 mb-8 text-center">About Us</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="bg-white p-8 rounded-lg shadow-sm border border-neutral-200">
                    <p class="text-neutral-700 mb-6">Our class is more than just a group of students; we are a family that supports and inspires each other. Together, we strive for excellence in our academic pursuits while creating lasting memories and friendships.</p>
                    <p class="text-neutral-700">We believe in the power of collaboration, creativity, and continuous learning. Our diverse talents and shared commitment to growth make our class unique and special.</p>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($members as $member)
                        @if(in_array($member->position, ['komisaris', 'sekretaris', 'bendahara']))
                            <div class="bg-white rounded-lg p-4 text-center shadow-sm border border-neutral-200 transition-all duration-300 hover:shadow-md">
                                <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}" 
                                     alt="{{ $member->full_name }}" 
                                     class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-2 border-primary/20">
                                <h3 class="font-medium text-neutral-800">{{ $member->full_name }}</h3>
                                <p class="text-sm text-neutral-600 capitalize">{{ $member->position }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Photos Section -->
    <section class="py-16 px-6 bg-white">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl font-playfair font-bold text-neutral-800 mb-8 text-center">Latest Activities</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($latestPhotos as $category)
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-neutral-200 transition-all duration-300 hover:shadow-md">
                        <img src="{{ asset('storage/' . $category->cover_image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-playfair font-bold text-xl text-neutral-800 mb-2">{{ $category->name }}</h3>
                            <p class="text-neutral-600 mb-4">{{ Str::limit($category->description, 100) }}</p>
                            <a href="{{ route('gallery') }}" class="text-primary hover:text-primary-dark transition-colors font-medium inline-flex items-center">
                                View Photos 
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 px-6 bg-subtle-gradient">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl font-playfair font-bold text-neutral-800 mb-8 text-center">What People Say</h2>
            
            @if($testimonials->isNotEmpty())
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-neutral-200">
                            <div class="flex items-center mb-4">
                                <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-medium text-neutral-800">{{ $testimonial->name }}</h3>
                                    <p class="text-sm text-neutral-600">{{ $testimonial->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="relative">
                                <svg class="absolute -top-2 -left-2 w-8 h-8 text-primary/10" fill="currentColor" viewBox="0 0 32 32">
                                    <path d="M10 8c-3.314 0-6 2.686-6 6s2.686 6 6 6c.628 0 1.232-.096 1.801-.276.65 1.394 2.476 3.276 5.199 3.276v-2c-2.571 0-4-2.429-4-5 0-3.314-1.343-6-3-8zm15 0c-3.314 0-6 2.686-6 6s2.686 6 6 6c.628 0 1.232-.096 1.801-.276.65 1.394 2.476 3.276 5.199 3.276v-2c-2.571 0-4-2.429-4-5 0-3.314-1.343-6-3-8z"/>
                                </svg>
                                <blockquote class="text-neutral-700 pl-6">{{ Str::limit($testimonial->message, 150) }}</blockquote>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-neutral-600">No testimonials yet. Be the first one to leave a message!</p>
            @endif

            <div class="text-center mt-8">
                <a href="{{ route('contact') }}" class="inline-flex items-center text-primary hover:text-primary-dark transition-colors">
                    <span>Share Your Thoughts</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-16 px-6 bg-subtle-gradient">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl font-playfair font-bold text-neutral-800 mb-8 text-center">Our Journey</h2>
            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-px bg-neutral-300"></div>
                
                <!-- Timeline items -->
                <div class="space-y-12">
                    <!-- Item 1 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-primary w-3 h-3 rounded-full shadow-sm"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-neutral-200 inline-block">
                                <h3 class="font-medium text-neutral-800">First Semester Begins</h3>
                                <p class="text-neutral-600">September 2023</p>
                                <p class="mt-2 text-neutral-700">Botak Era</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-primary w-3 h-3 rounded-full shadow-sm"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-neutral-200 inline-block">
                                <h3 class="font-medium text-neutral-800">Semester II</h3>
                                <p class="text-neutral-600">Maret 2024</p>
                                <p class="mt-2 text-neutral-700">Tiba-tiba Aja</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-primary w-3 h-3 rounded-full shadow-sm"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-neutral-200 inline-block">
                                <h3 class="font-medium text-neutral-800">Semester III</h3>
                                <p class="text-neutral-600">September 2024</p>
                                <p class="mt-2 text-neutral-700">Masa Sulit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout> 