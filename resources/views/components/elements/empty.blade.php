@props([ 'message' => null ])

<section class="text-black dark:text-white body-font w-1/2 mx-auto">

    <div class="container px-5 py-24 mx-auto flex flex-col items-center justify-center">

        <div class="flex flex-col mb-6 text-center">

            <h2 class="text-xs text-green-600 dark:text-green-800 tracking-widest font-medium title-font mb-1">{{ $message }}</h2>

            <h1 class="text-2xl md:text-3xl font-medium title-font text-green-600 dark:text-green-800">{{ __('Not Found') }}</h1>

        </div>

        <div class="flex items-center space-x-4">

            <img class="w-16" src="{{ asset('svgs/sidebar/search.svg') }}" alt="Search">

        </div>

    </div>

</section>
