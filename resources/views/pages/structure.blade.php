<x-app-layout>
    <!-- Structure Header -->
    <section class="bg-bone py-6 sm:py-6 px-4 sm:px-6 rounded-lg mx-4 my-4">
        <div class="max-w-screen-xl mx-auto text-center">
            <h1 class="text-2xl sm:text-3xl font-playfair font-bold text-gray-800 mb-2">Class Structure</h1>
            <p class="text-sm sm:text-base text-gray-700 max-w-2xl mx-auto">Meet our class organization and members.</p>
        </div>
    </section>

    <!-- Organizational Structure -->
    <section class="py-6 sm:py-8 px-4 sm:px-6">
        <div class="max-w-screen-lg mx-auto bg-white rounded-xl shadow-sm p-6">
            <!-- Komisaris Level -->
            <div class="text-center mb-8 sm:mb-12">
                @foreach($leaders as $leader)
                    @if($leader->position === 'komisaris')
                        <div class="relative cursor-pointer inline-block" onclick="showModal('member-{{ $leader->id }}')">
                            <div class="w-24 h-24 sm:w-32 sm:h-32 mx-auto rounded-full overflow-hidden mb-2 sm:mb-3 ring-4 ring-tan shadow-lg">
                                <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}"
                                     alt="{{ $leader->full_name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-base sm:text-lg font-medium text-gray-800">{{ $leader->full_name }}</h3>
                            <p class="text-xs sm:text-sm text-tan capitalize">{{ $leader->position }}</p>
                        </div>
                    @endif
                @endforeach
                <!-- Vertical Line -->
                <div class="vertical-connector w-px h-8 sm:h-12 bg-tan/50 mx-auto mt-3"></div>
            </div>

            <!-- Secretary and Treasurer Level -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8 sm:mb-12 max-w-xl mx-auto">
                <!-- Vertical Lines to Secretary and Treasurer -->
                <div class="vertical-connector absolute left-1/2 transform -translate-x-1/2 -mt-8 sm:-mt-12 hidden sm:block">
                    <div class="flex justify-between w-[250px] md:w-[400px] relative">
                        <div class="w-px h-6 bg-tan/50"></div>
                        <div class="w-px h-6 bg-tan/50"></div>
                    </div>
                </div>

                @foreach($leaders as $leader)
                    @if(in_array($leader->position, ['sekretaris', 'bendahara']))
                        <div class="text-center">
                            <div class="relative cursor-pointer inline-block" onclick="showModal('member-{{ $leader->id }}')">
                                <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto rounded-full overflow-hidden mb-2 sm:mb-3 ring-3 ring-tan/70 shadow-lg">
                                    <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}"
                                         alt="{{ $leader->full_name }}"
                                         class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-sm sm:text-base font-medium text-gray-800">{{ $leader->full_name }}</h3>
                                <p class="text-xs text-tan capitalize">{{ $leader->position }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Vertical Line to Members -->
            <div class="vertical-connector w-px h-8 sm:h-10 bg-tan/50 mx-auto -mt-4 sm:-mt-6 mb-4 sm:mb-6"></div>

            <!-- Members Level -->
            <div class="bg-bone/30 rounded-xl p-4 sm:p-6">
                <h2 class="text-lg sm:text-xl font-playfair font-bold text-gray-800 mb-4 sm:mb-6 text-center">Class Members</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4">
                    @foreach($members as $member)
                        <div class="text-center cursor-pointer transform hover:scale-105 transition-transform duration-300" onclick="showModal('member-{{ $member->id }}')">
                            <div class="bg-white rounded-lg p-2 sm:p-3 shadow-sm hover:shadow-md transition-shadow">
                                <div class="w-14 h-14 sm:w-20 sm:h-20 mx-auto rounded-full overflow-hidden mb-2 ring-2 ring-tan/30">
                                    <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}"
                                         alt="{{ $member->full_name }}"
                                         class="w-full h-full object-cover">
                                </div>
                                <h3 class="font-medium text-gray-800 text-xs">{{ $member->full_name }}</h3>
                                <p class="text-[10px] sm:text-xs text-gray-600 truncate px-1">{{ $member->study_program }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Member Modals -->
    @foreach($leaders->merge($members) as $member)
        <div id="member-{{ $member->id }}" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black/50" onclick="hideModal('member-{{ $member->id }}')"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[85%] sm:w-[70%] max-w-md bg-white rounded-xl shadow-xl animate-modal-appear">
                <div class="relative">
                    <!-- Header with background -->
                    <div class="bg-bone rounded-t-xl p-4 text-center relative">
                        <button onclick="hideModal('member-{{ $member->id }}')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <div class="w-20 h-20 sm:w-28 sm:h-28 mx-auto rounded-full overflow-hidden mb-3 ring-4 ring-white shadow-lg">
                            <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}"
                                 alt="{{ $member->full_name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg sm:text-xl font-playfair font-bold text-gray-800">{{ $member->full_name }}</h3>
                        <p class="text-sm text-tan capitalize mt-1">{{ $member->position }}</p>
                    </div>

                    <!-- Content -->
                    <div class="p-4 space-y-3 rounded-b-xl bg-gray-50">
                        <!-- Basic Info -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-lg">
                                <h4 class="text-xs font-medium text-gray-500">NIM</h4>
                                <p class="text-sm text-gray-800 font-medium">{{ $member->nim }}</p>
                            </div>

                            <div class="rounded-lg">
                                <h4 class="text-xs font-medium text-gray-500">Program Studi</h4>
                                <p class="text-sm text-gray-800">{{ $member->study_program }}</p>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        @if($member->status)
                            <div class="bg-gray-50 p-2 rounded-lg">
                                <h4 class="text-xs font-medium text-gray-500">Status</h4>
                                <p class="text-sm text-gray-800">{{ $member->status }}</p>
                            </div>
                        @endif

                        @if($member->hobbies)
                            <div class="bg-gray-50 p-2 rounded-lg">
                                <h4 class="text-xs font-medium text-gray-500">Hobi</h4>
                                <p class="text-sm text-gray-800">{{ $member->hobbies }}</p>
                            </div>
                        @endif

                        @if($member->favorite_quote)
                            <div class="bg-gray-50 p-2 rounded-lg">
                                <h4 class="text-xs font-medium text-gray-500">Quote Favorit</h4>
                                <p class="text-sm text-gray-800 italic">"{{ $member->favorite_quote }}"</p>
                            </div>
                        @endif

                        @if($member->social_media_links)
                            <div class="bg-gray-50 p-2 rounded-lg">
                                <h4 class="text-xs font-medium text-gray-500 mb-2">Media Sosial</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($member->social_media_links as $platform => $url)
                                        <a href="{{ $url }}"
                                           target="_blank"
                                           class="inline-flex items-center px-2 py-1 rounded-full bg-tan/10 text-tan hover:bg-tan/20 transition-colors text-xs">
                                            {{ ucfirst($platform) }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
    <script>
        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function hideModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
    @endpush
</x-app-layout>
