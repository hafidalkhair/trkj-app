<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-bone py-32 px-6">
        <div class="max-w-screen-xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-playfair font-bold text-gray-800 mb-6">Welcome to Our Class Portfolio</h1>
            <p class="text-lg md:text-xl text-gray-700 mb-8 max-w-2xl mx-auto">Discover our journey, achievements, and memories through this digital showcase of our class activities and accomplishments.</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('gallery') }}" class="bg-tan hover:bg-tan/90 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                    View Gallery
                </a>
                <a href="{{ route('contact') }}" class="bg-white hover:bg-gray-50 text-gray-800 font-medium py-3 px-6 rounded-lg transition-colors">
                    Contact Us
                </a>
            </div>
        </div>
        <div class="absolute inset-0 bg-[url('/public/images/pattern.png')] opacity-10"></div>
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
                <div class="grid grid-cols-2 gap-4">
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
                            <p class="text-gray-600">August 2023</p>
                            <p class="mt-2 text-gray-700">Start of our academic journey together</p>
                        </div>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-tan w-4 h-4 rounded-full"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-800">Mid-Term Projects</h3>
                            <p class="text-gray-600">October 2023</p>
                            <p class="mt-2 text-gray-700">Successfully completed group projects</p>
                        </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="relative">
                        <div class="flex items-center justify-center">
                            <div class="bg-tan w-4 h-4 rounded-full"></div>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="font-medium text-gray-800">Class Exhibition</h3>
                            <p class="text-gray-600">December 2023</p>
                            <p class="mt-2 text-gray-700">Showcasing our semester achievements</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout> 