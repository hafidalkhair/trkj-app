<x-app-layout>
    <style>
        .animate-modal-appear {
            animation: modalAppear 0.3s ease-out;
        }
        
        @keyframes modalAppear {
            from {
                opacity: 0;
                transform: translate(-50%, -48%) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        @media (max-width: 768px) {
            .vertical-connector {
                display: none;
            }
        }
    </style>

    <!-- Structure Header -->
    <section class="bg-bone py-10 sm:py-8 px-4 sm:px-6">
        <div class="max-w-screen-xl mx-auto text-center">
            <h1 class="text-3xl sm:text-4xl font-playfair font-bold text-gray-800 mb-3 sm:mb-4">Class Structure</h1>
            <p class="text-base sm:text-lg text-gray-700 max-w-2xl mx-auto">Meet our class organization and members.</p>
        </div>
    </section>

    <!-- Organizational Structure -->
    <section class="py-8 sm:py-12 px-4 sm:px-6">
        <div class="max-w-screen-xl mx-auto">
            <!-- Komisaris Level -->
            <div class="text-center mb-12 sm:mb-16">
                @foreach($leaders as $leader)
                    @if($leader->position === 'komisaris')
                        <div class="relative cursor-pointer inline-block" onclick="showModal('member-{{ $leader->id }}')">
                            <div class="w-32 h-32 sm:w-40 sm:h-40 mx-auto rounded-full overflow-hidden mb-3 sm:mb-4 ring-4 ring-tan shadow-lg">
                                <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}" 
                                     alt="{{ $leader->full_name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-lg sm:text-xl font-medium text-gray-800">{{ $leader->full_name }}</h3>
                            <p class="text-sm sm:text-base text-tan capitalize">{{ $leader->position }}</p>
                        </div>
                    @endif
                @endforeach
                <!-- Vertical Line -->
                <div class="vertical-connector w-px h-12 sm:h-16 bg-tan/50 mx-auto mt-4"></div>
            </div>

            <!-- Secretary and Treasurer Level -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-12 sm:mb-16 max-w-2xl mx-auto">
                <!-- Vertical Lines to Secretary and Treasurer -->
                <div class="vertical-connector absolute left-1/2 transform -translate-x-1/2 -mt-12 sm:-mt-16 hidden sm:block">
                    <div class="flex justify-between w-[300px] md:w-[500px] relative">
                        <div class="w-px h-8 bg-tan/50"></div>
                        <div class="w-px h-8 bg-tan/50"></div>
                    </div>
                </div>

                @foreach($leaders as $leader)
                    @if(in_array($leader->position, ['sekretaris', 'bendahara']))
                        <div class="text-center">
                            <div class="relative cursor-pointer inline-block" onclick="showModal('member-{{ $leader->id }}')">
                                <div class="w-28 h-28 sm:w-32 sm:h-32 mx-auto rounded-full overflow-hidden mb-3 sm:mb-4 ring-4 ring-tan/70 shadow-lg">
                                    <img src="{{ $leader->profile_image ? asset('storage/' . $leader->profile_image) : asset('images/default-avatar.png') }}" 
                                         alt="{{ $leader->full_name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-base sm:text-lg font-medium text-gray-800">{{ $leader->full_name }}</h3>
                                <p class="text-sm text-tan capitalize">{{ $leader->position }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Vertical Line to Members -->
            <div class="vertical-connector w-px h-12 sm:h-16 bg-tan/50 mx-auto -mt-6 sm:-mt-8 mb-6 sm:mb-8"></div>

            <!-- Members Level -->
            <div class="bg-bone/30 rounded-xl p-4 sm:p-8">
                <h2 class="text-xl sm:text-2xl font-playfair font-bold text-gray-800 mb-6 sm:mb-8 text-center">Class Members</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-6">
                    @foreach($members as $member)
                        <div class="text-center cursor-pointer transform hover:scale-105 transition-transform duration-300" onclick="showModal('member-{{ $member->id }}')">
                            <div class="bg-white rounded-lg p-3 sm:p-4 shadow-md hover:shadow-lg transition-shadow">
                                <div class="w-16 h-16 sm:w-24 sm:h-24 mx-auto rounded-full overflow-hidden mb-2 sm:mb-3 ring-2 ring-tan/30">
                                    <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}" 
                                         alt="{{ $member->full_name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <h3 class="font-medium text-gray-800 text-xs sm:text-sm">{{ $member->full_name }}</h3>
                                <p class="text-xs text-gray-600 truncate px-1">{{ $member->study_program }}</p>
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
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[95%] sm:w-full max-w-lg bg-white rounded-lg shadow-xl animate-modal-appear">
                <div class="relative">
                    <!-- Header with background -->
                    <div class="bg-bone rounded-t-lg p-4 sm:p-6 text-center relative">
                        <button onclick="hideModal('member-{{ $member->id }}')" class="absolute top-2 right-2 sm:top-4 sm:right-4 text-gray-600 hover:text-gray-800 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        
                        <div class="w-24 h-24 sm:w-32 sm:h-32 mx-auto rounded-full overflow-hidden mb-3 sm:mb-4 ring-4 ring-white shadow-lg">
                            <img src="{{ $member->profile_image ? asset('storage/' . $member->profile_image) : asset('images/default-avatar.png') }}" 
                                 alt="{{ $member->full_name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-xl sm:text-2xl font-playfair font-bold text-gray-800">{{ $member->full_name }}</h3>
                        <p class="text-sm sm:text-base text-tan capitalize mt-1">{{ $member->position }}</p>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
                        <!-- Basic Info -->
                        <div class="grid grid-cols-2 gap-3 sm:gap-4">
                            <div class="bg-gray-50 p-2 sm:p-3 rounded-lg">
                                <h4 class="text-xs sm:text-sm font-medium text-gray-500">NIM</h4>
                                <p class="text-sm sm:text-base text-gray-800 font-medium">{{ $member->nim }}</p>
                            </div>
                            
                            <div class="bg-gray-50 p-2 sm:p-3 rounded-lg">
                                <h4 class="text-xs sm:text-sm font-medium text-gray-500">Program Studi</h4>
                                <p class="text-sm sm:text-base text-gray-800">{{ $member->study_program }}</p>
                            </div>
                        </div>
                        
                        <!-- Additional Info -->
                        @if($member->status)
                            <div class="bg-gray-50 p-2 sm:p-3 rounded-lg">
                                <h4 class="text-xs sm:text-sm font-medium text-gray-500">Status</h4>
                                <p class="text-sm sm:text-base text-gray-800">{{ $member->status }}</p>
                            </div>
                        @endif
                        
                        @if($member->hobbies)
                            <div class="bg-gray-50 p-2 sm:p-3 rounded-lg">
                                <h4 class="text-xs sm:text-sm font-medium text-gray-500">Hobi</h4>
                                <p class="text-sm sm:text-base text-gray-800">{{ $member->hobbies }}</p>
                            </div>
                        @endif
                        
                        @if($member->favorite_quote)
                            <div class="bg-gray-50 p-2 sm:p-3 rounded-lg">
                                <h4 class="text-xs sm:text-sm font-medium text-gray-500">Quote Favorit</h4>
                                <p class="text-sm sm:text-base text-gray-800 italic">"{{ $member->favorite_quote }}"</p>
                            </div>
                        @endif
                        
                        @if($member->social_media_links)
                            <div class="bg-gray-50 p-2 sm:p-3 rounded-lg">
                                <h4 class="text-xs sm:text-sm font-medium text-gray-500 mb-2">Media Sosial</h4>
                                <div class="flex flex-wrap gap-2 sm:gap-3">
                                    @foreach($member->social_media_links as $platform => $url)
                                        <a href="{{ $url }}" 
                                           target="_blank" 
                                           class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full bg-tan/10 text-tan hover:bg-tan/20 transition-colors text-xs sm:text-sm">
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