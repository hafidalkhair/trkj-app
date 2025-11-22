<footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 pt-16 pb-8 transition-colors duration-300">
    <div class="max-w-screen-xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            <!-- 1. Brand & Description -->
            <div class="space-y-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-teal-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-teal-500/30 group-hover:rotate-12 transition-transform duration-300">
                        C
                    </div>
                    <span class="self-center text-2xl font-bold whitespace-nowrap text-slate-900 dark:text-white tracking-tight">
                        Copium<span class="text-teal-600">.</span>
                    </span>
                </a>
                <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                    More than just a class. We are a family of dreamers, achievers, and future leaders. Building memories that last a lifetime.
                </p>
            </div>

            <!-- 2. Quick Links -->
            <div>
                <h2 class="mb-6 text-sm font-bold text-slate-900 uppercase tracking-widest dark:text-white">Explore</h2>
                <ul class="text-slate-600 dark:text-slate-400 font-medium space-y-4">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-teal-600 dark:hover:text-teal-400 transition-colors inline-flex items-center group">
                            <span class="w-0 group-hover:w-2 h-0.5 bg-teal-600 mr-0 group-hover:mr-2 transition-all duration-300"></span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}" class="hover:text-teal-600 dark:hover:text-teal-400 transition-colors inline-flex items-center group">
                            <span class="w-0 group-hover:w-2 h-0.5 bg-teal-600 mr-0 group-hover:mr-2 transition-all duration-300"></span>
                            Gallery
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('structure') }}" class="hover:text-teal-600 dark:hover:text-teal-400 transition-colors inline-flex items-center group">
                            <span class="w-0 group-hover:w-2 h-0.5 bg-teal-600 mr-0 group-hover:mr-2 transition-all duration-300"></span>
                            Our Team
                        </a>
                    </li>
                </ul>
            </div>

            <!-- 3. Contact Info -->
            <div>
                <h2 class="mb-6 text-sm font-bold text-slate-900 uppercase tracking-widest dark:text-white">Contact</h2>
                <ul class="text-slate-600 dark:text-slate-400 font-medium space-y-4">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-teal-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Lhokseumawe, Aceh<br>Indonesia</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-teal-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:hello@copium.class" class="hover:text-teal-600 transition-colors">hello@copium.class</a>
                    </li>
                </ul>
            </div>

            <!-- 4. Social Media -->
            <div>
                <h2 class="mb-6 text-sm font-bold text-slate-900 uppercase tracking-widest dark:text-white">Connect</h2>
                <div class="flex space-x-4">
                    <a href="https://instagram.com" target="_blank" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 hover:bg-teal-500 hover:text-white dark:hover:bg-teal-500 dark:hover:text-white transition-all duration-300 hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465 1.067-.047 1.409-.06 3.809-.06zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 hover:bg-teal-500 hover:text-white dark:hover:bg-teal-500 dark:hover:text-white transition-all duration-300 hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-200 dark:border-slate-800 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4 md:mb-0 text-center md:text-left">
                &copy; {{ date('Y') }} Copium Class. All rights reserved.
            </p>
            <div class="flex space-x-6 text-sm font-medium text-slate-500 dark:text-slate-400">
                <a href="#" class="hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
