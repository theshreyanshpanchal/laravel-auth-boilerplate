@props([ 'error' => null, 'messageBag' => null ])

@if (! is_null($messageBag))

    <div class="flex">

        <img src="{{ asset('svgs/utility/info.svg') }}" alt="Error" />

        <span class="text-red-500 ml-1">{{ $messageBag->first($error) }}</span>

    </div>

@else

    @if ($errors->has($error))

        <div class="flex">

            <img src="{{ asset('svgs/utility/info.svg') }}" alt="Error" />

            <span class="text-red-500 ml-1">{{ $errors->first($error) }}</span>

        </div>

    @endif

@endif
