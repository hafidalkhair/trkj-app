<x-app-layout>
    <x-slot name="title">Struktur Organisasi</x-slot>

    @php
        $toMemberJs = function ($member) {
            return array_merge($member->only([
                'id', 'full_name', 'nim', 'position', 'study_program',
                'favorite_quote', 'status', 'hobbies', 'social_media_links',
            ]), [
                'profile_image_url' => $member->profile_image
                    ? asset('storage/' . $member->profile_image)
                    : asset('images/default-avatar.png'),
            ]);
        };
        $membersJs = $members->map($toMemberJs)->values();

        $roleIcon = function (string $position) {
            return match ($position) {
                'komisaris' => 'M5 16L3 6l5.5 4L12 4l3.5 6L21 6l-2 10H5zm0 3h14',
                'bendahara' => 'M12 6v12m-4-4.5c0 1.38 1.79 2.5 4 2.5s4-1.12 4-2.5-1.79-2.5-4-2.5-4-1.12-4-2.5S9.79 6 12 6s4 1.12 4 2.5',
                'sekretaris' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 16l-4 1 1-4 9.5-9.5z',
                default => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
            };
        };
    @endphp

    <!-- HERO -->
    <section class="relative pt-40 pb-12 px-6 overflow-hidden text-center bg-slate-50 dark:bg-slate-950">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
            <div class="absolute top-10 left-1/4 w-[500px] h-[500px] bg-teal-500/10 dark:bg-teal-900/20 rounded-full blur-[120px] opacity-50"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto animate__animated animate__fadeInDown">
            <span class="inline-block py-2 px-4 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-teal-600 dark:text-teal-400 text-xs font-bold mb-6 tracking-widest uppercase shadow-lg">
                Organization
            </span>
            <h1 class="text-4xl md:text-6xl font-bold text-slate-900 dark:text-white mb-6 tracking-tight">
                Meet The <span class="text-teal-600">Team.</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                The dedicated individuals who lead, organize, and make everything possible for our class.
            </p>
        </div>
    </section>

    <div x-data="structurePage({{ \Illuminate\Support\Js::from($membersJs) }})"
         @keydown.escape.window="handleEscape()">

        <!-- HIERARCHY -->
        <section class="relative pb-28 px-6 bg-slate-50 dark:bg-slate-950 overflow-x-auto">
            <div class="min-w-[320px] max-w-5xl mx-auto relative">

                <!-- 1. KOMISARIS -->
                <div class="flex justify-center mb-16 relative z-10">
                    @foreach($leaders as $leader)
                        @if($leader->position === 'komisaris')
                            <div class="relative group" x-data="{ show: false }" x-intersect.once="show = true"
                                 :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                                 class="relative group transition-all duration-700">
                                <div class="relative bg-white dark:bg-slate-800 p-7 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-700 w-72 text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-teal-900/10 hover:border-teal-500 dark:hover:border-teal-500 cursor-pointer"
                                     @click="openMember({{ \Illuminate\Support\Js::from(($toMemberJs)($leader)) }})">

                                    <div class="relative w-28 h-28 mx-auto mb-4">
                                        <div class="absolute -inset-1 rounded-full bg-gradient-to-br from-teal-400 to-teal-700 opacity-80 group-hover:opacity-100 transition-opacity"></div>
                                        <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}"
                                             class="relative w-full h-full rounded-full object-cover object-center border-4 border-white dark:border-slate-800 transform transition-transform duration-500 group-hover:scale-105">
                                        <div class="absolute -bottom-1 -right-1 w-9 h-9 rounded-full bg-teal-600 border-4 border-white dark:border-slate-800 flex items-center justify-center shadow-md z-10">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $roleIcon($leader->position) }}"></path></svg>
                                        </div>
                                    </div>

                                    <h3 class="text-xl font-bold text-slate-900 dark:text-white group-hover:text-teal-600 transition-colors">{{ $leader->full_name }}</h3>
                                    <p class="text-teal-600 dark:text-teal-400 text-sm font-bold uppercase tracking-wider mt-1">{{ $leader->position }}</p>
                                </div>
                                <div class="absolute left-1/2 -bottom-8 w-px h-8 bg-gradient-to-b from-teal-500/60 to-slate-300 dark:to-slate-700"></div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Connector -->
                <div class="relative w-2/3 mx-auto h-px bg-slate-300 dark:bg-slate-700 mb-8 hidden md:block">
                    <div class="absolute left-1/2 -top-8 w-px h-8 bg-slate-300 dark:bg-slate-700 -translate-x-1/2"></div>
                    <div class="absolute left-0 top-0 w-px h-8 bg-slate-300 dark:bg-slate-700"></div>
                    <div class="absolute right-0 top-0 w-px h-8 bg-slate-300 dark:bg-slate-700"></div>
                    <div class="absolute left-1/2 -top-8 -translate-x-1/2 w-2 h-2 rounded-full bg-teal-500"></div>
                    <div class="absolute left-0 top-0 -translate-x-1/2 w-2 h-2 rounded-full bg-teal-500"></div>
                    <div class="absolute right-0 top-0 translate-x-1/2 w-2 h-2 rounded-full bg-teal-500"></div>
                </div>

                <!-- 2. SEKRETARIS & BENDAHARA -->
                <div class="flex flex-col md:flex-row justify-center md:justify-between gap-12 md:gap-24 mb-20 px-4 md:px-20">
                    @foreach(['sekretaris', 'bendahara'] as $pos)
                        <div class="flex flex-col items-center gap-6">
                            @foreach($leaders as $leader)
                                @if($leader->position === $pos)
                                    <div class="relative group" x-data="{ show: false }" x-intersect.once="show = true"
                                         :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                                         class="relative group transition-all duration-700">
                                        <div class="absolute left-1/2 -top-8 w-px h-8 bg-slate-300 dark:bg-slate-700 md:hidden"></div>

                                        <div class="relative bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-lg border border-slate-100 dark:border-slate-700 w-64 text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-teal-500 cursor-pointer"
                                             @click="openMember({{ \Illuminate\Support\Js::from(($toMemberJs)($leader)) }})">

                                            <div class="relative w-20 h-20 mx-auto mb-4">
                                                <div class="absolute -inset-1 rounded-full bg-gradient-to-br from-teal-300 to-teal-600 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                                                <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}"
                                                     class="relative w-full h-full object-cover object-center rounded-full border-4 border-white dark:border-slate-800 transform group-hover:scale-105 transition-transform duration-500">
                                                <div class="absolute -bottom-1 -right-1 w-7 h-7 rounded-full bg-teal-600 border-4 border-white dark:border-slate-800 flex items-center justify-center shadow-md z-10">
                                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $roleIcon($leader->position) }}"></path></svg>
                                                </div>
                                            </div>

                                            <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-teal-600 transition-colors">{{ $leader->full_name }}</h3>
                                            <p class="text-teal-600 dark:text-teal-400 text-xs font-bold uppercase tracking-wider mt-1">{{ $leader->position }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 3. ALL MEMBERS -->
        <section class="pb-32 px-6 bg-white dark:bg-slate-950">
            <div class="max-w-screen-xl mx-auto">
                <div class="text-center mb-12">
                    <span class="inline-block py-2 px-4 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-xs font-bold mb-4 tracking-widest uppercase">
                        Members
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white">All Class Members</h2>
                </div>

                <!-- Toolbar -->
                <div class="sticky top-24 z-30 mb-12 px-2 md:px-0">
                    <div class="bg-white/90 dark:bg-slate-900/90 border border-slate-200 dark:border-slate-700/50
                                rounded-3xl md:rounded-full shadow-xl
                                flex flex-col md:flex-row items-center
                                max-w-2xl mx-auto backdrop-blur-xl p-2 md:p-1.5 ring-1 ring-slate-900/5 transition-all duration-300">

                        <div class="relative flex-grow w-full md:w-auto flex items-center px-4 h-12 md:h-auto">
                            <svg class="h-5 w-5 text-slate-400 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            <input type="text" x-model="search" placeholder="Cari nama anggota..."
                                   class="w-full bg-transparent border-none focus:ring-0 text-sm font-medium text-slate-900 dark:text-white placeholder-slate-500 p-0 focus:outline-none">
                        </div>

                        <div class="w-full h-px bg-slate-100 dark:bg-slate-700/50 md:w-px md:h-8 md:bg-slate-200 md:dark:bg-slate-700 my-1 md:my-0 mx-0 md:mx-2"></div>

                        <div class="relative w-full md:w-auto min-w-[200px]">
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500 dark:text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                            </div>
                            <select x-model="programFilter"
                                    class="w-full h-12 md:h-auto pl-5 pr-12 py-2 bg-transparent border-none focus:ring-0 rounded-xl text-sm font-bold text-slate-700 dark:text-white appearance-none cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors text-left md:text-right focus:outline-none">
                                <option value="all">Semua Prodi</option>
                                <template x-for="program in programs" :key="program">
                                    <option :value="program" x-text="program"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    <template x-for="member in filteredMembers" :key="member.id">
                        <div class="group bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-teal-500 cursor-pointer transition-all text-center"
                             @click="openMember(member)">
                            <div class="relative w-16 h-16 mx-auto mb-3 rounded-full overflow-hidden">
                                <img :src="member.profile_image_url"
                                     class="w-full h-full object-cover object-center border-2 border-slate-100 dark:border-slate-700 group-hover:border-teal-500 transition-colors rounded-full">
                            </div>
                            <h4 class="text-sm font-bold text-slate-900 dark:text-white truncate" x-text="member.full_name"></h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 truncate" x-text="member.study_program"></p>
                        </div>
                    </template>
                </div>

                <div x-show="filteredMembers.length === 0" class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 dark:bg-slate-800 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-slate-500">Anggota tidak ditemukan.</p>
                </div>
            </div>
        </section>

        <!-- MEMBER DETAIL MODAL (single, Alpine-driven) -->
        <template x-if="selectedMember">
            <div class="fixed inset-0 z-[100]" @click.self="closeMember()"
                 x-show="selectedMember" x-transition.opacity>
                <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] max-w-md bg-white dark:bg-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-700"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95">

                    <div class="h-32 bg-gradient-to-r from-teal-500 to-teal-800 relative">
                        <button @click="closeMember()" class="absolute top-4 right-4 bg-black/20 hover:bg-black/40 text-white rounded-full p-2 transition-colors z-20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="px-8 pb-8 -mt-12 relative">
                        <div class="w-24 h-24 rounded-full border-4 border-white dark:border-slate-900 overflow-hidden shadow-md bg-white cursor-zoom-in group relative"
                             @click.stop="lightboxImage = selectedMember.profile_image_url">
                            <img :src="selectedMember.profile_image_url"
                                 class="w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white" x-text="selectedMember.full_name"></h3>
                            <span class="inline-block bg-teal-100 dark:bg-teal-900/50 text-teal-700 dark:text-teal-300 text-xs px-2 py-1 rounded font-bold uppercase tracking-wide mt-1" x-text="selectedMember.position"></span>
                        </div>

                        <div class="mt-6 space-y-4">
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl">
                                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">NIM</p>
                                <p class="text-slate-900 dark:text-white font-medium" x-text="selectedMember.nim"></p>
                            </div>

                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl" x-show="selectedMember.favorite_quote">
                                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Quote</p>
                                <p class="text-slate-900 dark:text-white italic" x-text="'&quot;' + selectedMember.favorite_quote + '&quot;'"></p>
                            </div>

                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl" x-show="selectedMember.status">
                                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Status</p>
                                <p class="text-slate-900 dark:text-white italic" x-text="selectedMember.status"></p>
                            </div>

                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl" x-show="selectedMember.hobbies">
                                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Hobi</p>
                                <p class="text-slate-900 dark:text-white italic" x-text="selectedMember.hobbies"></p>
                            </div>

                            <div class="flex gap-2 flex-wrap mt-4" x-show="selectedMember.social_media_links">
                                <template x-for="(url, platform) in (selectedMember.social_media_links || {})" :key="platform">
                                    <a :href="url" target="_blank" class="px-4 py-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-teal-500 hover:text-white transition-colors text-sm font-medium capitalize" x-text="platform"></a>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- LIGHTBOX -->
        <template x-if="lightboxImage">
            <div class="fixed inset-0 z-[200] bg-black/95 backdrop-blur-sm flex items-center justify-center cursor-zoom-out"
                 @click="lightboxImage = null" x-transition.opacity>
                <button class="absolute top-6 right-6 text-white/50 hover:text-white p-2 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <img :src="lightboxImage" @click.stop
                     class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-2xl"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
            </div>
        </template>
    </div>

    <script>
        function structurePage(members) {
            return {
                members: members,
                search: '',
                programFilter: 'all',
                selectedMember: null,
                lightboxImage: null,

                get programs() {
                    return [...new Set(this.members.map(m => m.study_program).filter(Boolean))].sort();
                },

                get filteredMembers() {
                    let list = this.members;
                    if (this.search) {
                        const query = this.search.toLowerCase();
                        list = list.filter(m => m.full_name.toLowerCase().includes(query));
                    }
                    if (this.programFilter !== 'all') {
                        list = list.filter(m => m.study_program === this.programFilter);
                    }
                    return list;
                },

                openMember(member) {
                    this.selectedMember = member;
                    document.body.classList.add('no-scroll');
                },
                closeMember() {
                    this.selectedMember = null;
                    document.body.classList.remove('no-scroll');
                },
                handleEscape() {
                    if (this.lightboxImage) this.lightboxImage = null;
                    else if (this.selectedMember) this.closeMember();
                },
            }
        }
    </script>
</x-app-layout>
