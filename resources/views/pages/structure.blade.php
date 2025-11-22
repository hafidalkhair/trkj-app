<x-app-layout>
    <!-- Header -->
    <section class="pt-40 pb-12 px-6 text-center bg-slate-50 dark:bg-slate-950">
        <span class="inline-block py-2 px-4 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-xs font-bold mb-6 tracking-widest uppercase animate__animated animate__fadeInDown">
            Organization
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-slate-900 dark:text-white mb-6 tracking-tight animate__animated animate__fadeInUp">
            Meet The <span class="text-teal-600">Team.</span>
        </h1>
        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s">
            The dedicated individuals who lead, organize, and make everything possible for our class.
        </p>
    </section>

    <!-- Hierarchy View -->
    <section class="pb-32 px-6 bg-slate-50 dark:bg-slate-950 overflow-x-auto">
        <div class="min-w-[320px] max-w-5xl mx-auto relative">

            <!-- 1. KOMISARIS (Top Level) -->
            <div class="flex justify-center mb-16 relative z-10">
                @foreach($leaders as $leader)
                    @if($leader->position === 'komisaris')
                        <!-- Card Container -->
                        <div class="relative group">
                            <!-- Card Content -->
                            <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-700 w-64 text-center transition-all duration-300 hover:-translate-y-2 hover:border-teal-500 dark:hover:border-teal-500">

                                <!-- FOTO PROFIL YANG BISA DIKLIK -->
                                <div class="relative w-24 h-24 mx-auto mb-4 group-avatar cursor-pointer" onclick="showModal('member-{{ $leader->id }}')">
                                    <div class="absolute inset-0 rounded-full border-4 border-teal-50 dark:border-teal-900 group-hover:border-teal-500 transition-colors z-10"></div>
                                    <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}"
                                         class="w-full h-full rounded-full object-cover object-center transform transition-transform duration-500 group-hover:scale-110">

                                    <!-- Overlay Icon Click -->
                                    <div class="absolute inset-0 rounded-full bg-black/30 opacity-0 hover:opacity-100 flex items-center justify-center transition-opacity duration-300 z-20">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </div>
                                </div>

                                <h3 class="text-xl font-bold text-slate-900 dark:text-white cursor-pointer hover:text-teal-600 transition-colors" onclick="showModal('member-{{ $leader->id }}')">{{ $leader->full_name }}</h3>
                                <p class="text-teal-600 dark:text-teal-400 text-sm font-bold uppercase tracking-wider mt-1">{{ $leader->position }}</p>
                            </div>
                            <!-- Connector Point Bottom -->
                            <div class="absolute left-1/2 -bottom-8 w-px h-8 bg-slate-300 dark:bg-slate-700"></div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Connector Horizontal Line -->
            <div class="relative w-2/3 mx-auto h-px bg-slate-300 dark:bg-slate-700 mb-8 hidden md:block">
                <div class="absolute left-1/2 -top-8 w-px h-8 bg-slate-300 dark:bg-slate-700 -translate-x-1/2"></div>
                <div class="absolute left-0 top-0 w-px h-8 bg-slate-300 dark:bg-slate-700"></div>
                <div class="absolute right-0 top-0 w-px h-8 bg-slate-300 dark:bg-slate-700"></div>
            </div>

            <!-- 2. SEKRETARIS & BENDAHARA -->
            <div class="flex flex-col md:flex-row justify-center md:justify-between gap-12 md:gap-24 mb-24 px-4 md:px-20">
                @foreach(['sekretaris', 'bendahara'] as $pos)
                    <div class="flex flex-col items-center gap-6">
                        @foreach($leaders as $leader)
                            @if($leader->position === $pos)
                                <div class="relative group">
                                    <div class="absolute left-1/2 -top-8 w-px h-8 bg-slate-300 dark:bg-slate-700 md:hidden"></div>

                                    <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-lg border border-slate-100 dark:border-slate-700 w-64 text-center transition-all duration-300 hover:-translate-y-2 hover:border-teal-500">
                                        <!-- FOTO BISA DIKLIK -->
                                        <div class="relative w-20 h-20 mx-auto mb-4 cursor-pointer rounded-full overflow-hidden" onclick="showModal('member-{{ $leader->id }}')">
                                            <div class="absolute inset-0 border-4 border-slate-100 dark:border-slate-700 group-hover:border-teal-500 transition-colors z-10 rounded-full"></div>
                                            <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}"
                                                 class="w-full h-full object-cover object-center rounded-full transform group-hover:scale-110 transition-transform duration-500">
                                            <!-- Overlay Icon -->
                                            <div class="absolute inset-0 bg-black/30 opacity-0 hover:opacity-100 flex items-center justify-center transition-opacity duration-300 z-20 rounded-full">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </div>
                                        </div>

                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white cursor-pointer" onclick="showModal('member-{{ $leader->id }}')">{{ $leader->full_name }}</h3>
                                        <p class="text-teal-600 dark:text-teal-400 text-xs font-bold uppercase tracking-wider mt-1">{{ $leader->position }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- 3. ALL MEMBERS GRID -->
            <div class="mt-20 border-t border-slate-200 dark:border-slate-800 pt-16">
                <h2 class="text-3xl font-bold text-center text-slate-900 dark:text-white mb-12">All Class Members</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($members as $member)
                        <div class="group bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md hover:border-teal-500 cursor-pointer transition-all text-center"
                             onclick="showModal('member-{{ $member->id }}')">
                            <div class="relative w-16 h-16 mx-auto mb-3 rounded-full overflow-hidden">
                                <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}"
                                     class="w-full h-full object-cover object-center border-2 border-slate-100 dark:border-slate-700 group-hover:border-teal-500 transition-colors rounded-full">
                            </div>
                            <h4 class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $member->full_name }}</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate">{{ $member->study_program }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- MEMBER DETAIL MODALS (Sama seperti sebelumnya) -->
    @foreach($leaders->merge($members) as $member)
        <div id="member-{{ $member->id }}" class="fixed inset-0 z-[100] hidden transition-opacity duration-300" aria-hidden="true">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="hideModal('member-{{ $member->id }}')"></div>

            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[90%] max-w-md bg-white dark:bg-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-700 animate__animated animate__zoomIn animate__faster">

                <div class="h-32 bg-gradient-to-r from-teal-500 to-blue-600 relative">
                    <button onclick="hideModal('member-{{ $member->id }}')" class="absolute top-4 right-4 bg-black/20 hover:bg-black/40 text-white rounded-full p-2 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="px-8 pb-8 -mt-12 relative">
                    <div class="w-24 h-24 rounded-full border-4 border-white dark:border-slate-900 overflow-hidden shadow-md bg-white">
                        <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}" class="w-full h-full object-cover object-center">
                    </div>

                    <div class="mt-4">
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $member->full_name }}</h3>
                        <span class="inline-block bg-teal-100 dark:bg-teal-900/50 text-teal-700 dark:text-teal-300 text-xs px-2 py-1 rounded font-bold uppercase tracking-wide mt-1">
                            {{ $member->position }}
                        </span>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl">
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">NIM</p>
                            <p class="text-slate-900 dark:text-white font-medium">{{ $member->nim }}</p>
                        </div>

                        @if($member->favorite_quote)
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl">
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Quote</p>
                            <p class="text-slate-900 dark:text-white italic">"{{ $member->favorite_quote }}"</p>
                        </div>
                        @endif

                        @if($member->status)
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl">
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Status</p>
                            <p class="text-slate-900 dark:text-white italic">"{{ $member->status }}"</p>
                        </div>
                        @endif

                        @if($member->hobbies)
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl">
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Hobi</p>
                            <p class="text-slate-900 dark:text-white italic">"{{ $member->hobbies }}"</p>
                        </div>
                        @endif

                        @if($member->social_media_links)
                        <div class="flex gap-2 flex-wrap mt-4">
                            @foreach($member->social_media_links as $platform => $url)
                                <a href="{{ $url }}" target="_blank" class="px-4 py-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-teal-500 hover:text-white transition-colors text-sm font-medium capitalize">
                                    {{ $platform }}
                                </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
    <script>
        function showModal(id) {
            const el = document.getElementById(id);
            el.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function hideModal(id) {
            const el = document.getElementById(id);
            el.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
    @endpush
</x-app-layout>
