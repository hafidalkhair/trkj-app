<x-app-layout>
    <section class="pt-40 pb-24 px-6 bg-slate-50 dark:bg-slate-950 min-h-screen flex items-center">
        <div class="max-w-screen-xl mx-auto w-full">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

                <!-- LEFT: Information -->
                <div class="animate__animated animate__fadeInLeft">
                    <span class="inline-block py-2 px-4 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-xs font-bold mb-6 tracking-widest uppercase">
                        Get in Touch
                    </span>
                    <h1 class="text-5xl md:text-6xl font-bold text-slate-900 dark:text-white mb-8">
                        Let's Start a <br> <span class="text-teal-600">Conversation.</span>
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-400 mb-12 leading-relaxed">
                        Have questions about our class, events, or collaboration opportunities? We'd love to hear from you. Fill out the form or reach us directly.
                    </p>

                    <div class="space-y-8">
                        <div class="flex items-start group">
                            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 shadow-lg border border-slate-100 dark:border-slate-700 flex items-center justify-center text-teal-600 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">Our Base</h3>
                                <p class="text-slate-500 dark:text-slate-400">Lhokseumawe, Aceh<br>Indonesia</p>
                            </div>
                        </div>

                        <div class="flex items-start group">
                            <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 shadow-lg border border-slate-100 dark:border-slate-700 flex items-center justify-center text-teal-600 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">Email Us</h3>
                                <p class="text-slate-500 dark:text-slate-400">hello@copium.class<br>support@copium.class</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Form Card -->
                <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 md:p-12 shadow-2xl border border-slate-100 dark:border-slate-800 animate__animated animate__fadeInRight">
                    @if(session('success'))
                        <div class="mb-8 p-4 bg-teal-50 dark:bg-teal-900/30 border border-teal-200 dark:border-teal-800 rounded-xl flex items-center text-teal-800 dark:text-teal-300 animate__animated animate__fadeIn">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wide">Name</label>
                                <input type="text" name="name" id="name" required
                                       class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-teal-500 focus:ring-teal-500 transition-colors text-slate-900 dark:text-white placeholder-slate-400"
                                       placeholder="John Doe">
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wide">Email</label>
                                <input type="email" name="email" id="email" required
                                       class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-teal-500 focus:ring-teal-500 transition-colors text-slate-900 dark:text-white placeholder-slate-400"
                                       placeholder="john@example.com">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="subject" class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wide">Subject</label>
                            <input type="text" name="subject" id="subject" required
                                   class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-teal-500 focus:ring-teal-500 transition-colors text-slate-900 dark:text-white placeholder-slate-400"
                                   placeholder="What is this about?">
                        </div>

                        <div class="space-y-2">
                            <label for="message" class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wide">Message</label>
                            <textarea name="message" id="message" rows="5" required
                                      class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-teal-500 focus:ring-teal-500 transition-colors text-slate-900 dark:text-white placeholder-slate-400"
                                      placeholder="Tell us everything..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg shadow-teal-500/30 transition-all transform hover:scale-[1.02] flex justify-center items-center">
                            Send Message
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
</x-app-layout>
