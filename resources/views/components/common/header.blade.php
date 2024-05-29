<header class="h-20 flex items-center bg-gradient-to-bl from-green-500 to-green-600 dark:from-green-900 dark:to-green-700 rounded-xl text-white px-6 my-4 mr-4 relative">

    <button class="p-2 -ml-2 mr-2" @click="isExpanded = !isExpanded">

        <svg viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 transform" :class="isExpanded ? 'rotate-180' : 'rotate-0'">

            <path stroke="none" d="M0 0h24v24H0z" fill="none" />

            <line x1="4" y1="6" x2="14" y2="6" />

            <line x1="4" y1="18" x2="14" y2="18" />

            <path d="M4 12h17l-3 -3m0 6l3 -3" />

        </svg>

    </button>

    <div class="flex-grow"></div>

    <div class="relative" x-data="{ isOpen: false }">

        <button @click="isOpen = !isOpen" class="block h-12 w-12 rounded-full overflow-hidden focus:outline-none relative">

            @php($avatar = Avatar::create(auth()->user()->full_name)->toBase64())

            <img class="h-full w-full object-cover" src="{{ $avatar }}" alt="Avatar">

        </button>

        <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-40 p-2 bg-green-600 dark:bg-green-800 rounded shadow-xl transform origin-top transition-all duration-300" style="display: none;">

            <a href="{{ route('view:profile') }}" class="block p-2 text-normal text-white rounded">{{ __('Profile') }}</a>

        </div>

    </div>

</header>
