@if (session('success'))

    <div class="flex justify-center">

        <img src="{{ asset('svgs/utility/success.svg') }}" alt="Success" />

        <span class="text-green-500 ml-1">{{ session('success') }}</span>

    </div>

@endif
