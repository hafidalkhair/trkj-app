<x-app-layout>
    <!-- Contact Header -->
    <section class="bg-bone py-8 px-6">
        <div class="max-w-screen-xl mx-auto text-center">
            <h1 class="text-4xl font-playfair font-bold text-gray-800 mb-4">Contact Us</h1>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">Have any questions? We'd love to hear from you.</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-12 px-6">
        <div class="max-w-screen-xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-tan focus:border-tan" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-tan focus:border-tan" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                            <input type="text" name="subject" id="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-tan focus:border-tan" required>
                            @error('subject')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea name="message" id="message" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-tan focus:border-tan" required></textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-medium py-3 px-6 rounded-lg transition-colors duration-300 transform hover:scale-[0.99] flex items-center justify-center gap-2">
                            <span>Send Message</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Contact Info & Map -->
                <div>
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-2xl font-playfair font-bold text-gray-800 mb-4">Contact Information</h2>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-tan mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-800">Lhokseumawe</h3>
                                    <p class="text-gray-600">Bukitrata</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-tan mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-800">Email</h3>
                                    <p class="text-gray-600">trkj.pnl@gmail.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-tan mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-800">Phone</h3>
                                    <p class="text-gray-600">+12(200)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-playfair font-bold text-gray-800 mb-4">Location</h2>
                        <div class="aspect-video rounded-lg overflow-hidden">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.897237407334!2d97.15330922569129!3d5.120258611532006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3047833e1943e83d%3A0xf2376bb0a10f266!2sGedung%20Teknologi%20Informasi%20dan%20Komputer!5e0!3m2!1sid!2sid!4v1748091966496!5m2!1sid!2sid" 
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-12 px-6 bg-bone/30">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl font-playfair font-bold text-gray-800 mb-8 text-center">Frequently Asked Questions</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg p-6">
                    <h3 class="font-medium text-gray-800 mb-2">What is the purpose of this website?</h3>
                    <p class="text-gray-600">This website serves as a digital portfolio for our class, showcasing our activities, achievements, and members.</p>
                </div>

                <div class="bg-white rounded-lg p-6">
                    <h3 class="font-medium text-gray-800 mb-2">How can I join the class?</h3>
                    <p class="text-gray-600">Please contact the class administration through the contact form above for inquiries about joining our class.</p>
                </div>

                <div class="bg-white rounded-lg p-6">
                    <h3 class="font-medium text-gray-800 mb-2">How often is the gallery updated?</h3>
                    <p class="text-gray-600">Our gallery is regularly updated with new photos after each class event or activity.</p>
                </div>

                <div class="bg-white rounded-lg p-6">
                    <h3 class="font-medium text-gray-800 mb-2">Can I contribute to the website?</h3>
                    <p class="text-gray-600">Yes! Class members can contribute content through the class administration team.</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout> 