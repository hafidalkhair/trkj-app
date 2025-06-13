<x-app-layout>
    <!-- About Us Header -->
    <section class="bg-gradient-to-b from-bone to-bone/50 py-12 sm:py-16 md:py-20 px-4 sm:px-6 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('/images/pattern.png')] opacity-5"></div>
        <div class="max-w-screen-xl mx-auto text-center relative">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-playfair font-bold text-gray-800 mb-4 sm:mb-6">About Us</h1>
            <div class="max-w-3xl mx-auto px-2 sm:px-4">
                <p class="text-base sm:text-lg text-gray-600 leading-relaxed mb-6 sm:mb-8">
                    Our class is more than just a group of students; we are a family that supports and inspires each other. Together, we strive for excellence in our academic pursuits while creating lasting memories and friendships.
                </p>
                <p class="text-base sm:text-lg text-gray-600 leading-relaxed">
                    We believe in the power of collaboration, creativity, and continuous learning. Our diverse talents and shared commitment to growth make our class unique and special.
                </p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-12 sm:py-16 px-4 sm:px-6">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-playfair font-bold text-gray-800 text-center mb-8 sm:mb-12">Our Leadership Team</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8 max-w-4xl mx-auto">
                <!-- Komisaris -->
                <div class="group">
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-md group-hover:shadow-xl transition-all duration-300
                              transform group-hover:-translate-y-1 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-tan/5 to-tan/10 rounded-2xl opacity-0 
                                  group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="w-32 h-32 sm:w-40 sm:h-40 mx-auto rounded-full overflow-hidden mb-4 sm:mb-6 ring-4 ring-tan/70 shadow-lg
                                      group-hover:ring-offset-4 group-hover:ring-tan/60 transition-all duration-300">
                                <img src="{{ asset('storage/leaders/hafidl.jpg') }}" alt="L Hafidl Alkhair" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <h3 class="text-lg sm:text-xl font-medium text-gray-800 mb-1 text-center">L Hafidl Alkhair</h3>
                            <p class="text-sm sm:text-base text-tan capitalize font-medium text-center">Komisaris</p>
                        </div>
                    </div>
                </div>

                <!-- Bendahara -->
                <div class="group">
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-md group-hover:shadow-xl transition-all duration-300
                              transform group-hover:-translate-y-1 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-tan/5 to-tan/10 rounded-2xl opacity-0 
                                  group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="w-32 h-32 sm:w-40 sm:h-40 mx-auto rounded-full overflow-hidden mb-4 sm:mb-6 ring-4 ring-tan/70 shadow-lg
                                      group-hover:ring-offset-4 group-hover:ring-tan/60 transition-all duration-300">
                                <img src="{{ asset('storage/leaders/nathasya.jpg') }}" alt="Nathasya Azliza" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <h3 class="text-lg sm:text-xl font-medium text-gray-800 mb-1 text-center">Nathasya Azliza</h3>
                            <p class="text-sm sm:text-base text-tan capitalize font-medium text-center">Bendahara</p>
                        </div>
                    </div>
                </div>

                <!-- Sekretaris -->
                <div class="group sm:col-span-2 md:col-span-1 sm:max-w-sm sm:mx-auto md:max-w-none">
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-md group-hover:shadow-xl transition-all duration-300
                              transform group-hover:-translate-y-1 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-tan/5 to-tan/10 rounded-2xl opacity-0 
                                  group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="w-32 h-32 sm:w-40 sm:h-40 mx-auto rounded-full overflow-hidden mb-4 sm:mb-6 ring-4 ring-tan/70 shadow-lg
                                      group-hover:ring-offset-4 group-hover:ring-tan/60 transition-all duration-300">
                                <img src="{{ asset('storage/leaders/yasinta.jpg') }}" alt="Yasinta Shabilla" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <h3 class="text-lg sm:text-xl font-medium text-gray-800 mb-1 text-center">Yasinta Shabilla</h3>
                            <p class="text-sm sm:text-base text-tan capitalize font-medium text-center">Sekretaris</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-12 sm:py-16 px-4 sm:px-6 bg-gradient-to-br from-bone/20 to-bone/40">
        <div class="max-w-screen-xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 md:gap-12 max-w-4xl mx-auto">
                <!-- Vision -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg">
                    <div class="flex items-center mb-4 sm:mb-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-tan/10 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-tan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-playfair font-bold text-gray-800">Our Vision</h3>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                        To become a cohesive and supportive learning community that empowers each member to achieve their highest potential while fostering lasting friendships and meaningful experiences.
                    </p>
                </div>

                <!-- Mission -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-lg">
                    <div class="flex items-center mb-4 sm:mb-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-tan/10 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-tan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-playfair font-bold text-gray-800">Our Mission</h3>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                        To create an inclusive environment that promotes academic excellence, personal growth, and strong bonds between classmates through collaboration, mutual support, and shared experiences.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>