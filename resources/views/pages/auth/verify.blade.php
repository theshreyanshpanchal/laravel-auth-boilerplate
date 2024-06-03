@extends('layouts.guest')

@section('content')

<div class="h-screen bg-green-600 dark:bg-green-800 py-20 px-3">

    <div class="container mx-auto">

        <div class="max-w-sm mx-auto md:max-w-lg">

            <div class="w-full">

                <div class="bg-white dark:bg-gray-900 h-72 py-4 text-black dark:text-white text-center rounded-xl">

                    <div class="py-1">

                        @component('components.elements.success') @endcomponent

                    </div>

                    <h1 class="text-2xl font-bold">{{ __('OTP Verification') }}</h1>

                    <div class="flex flex-col mt-4">

                        <span>{{ __('Enter the OTP you received at') }}</span>

                          <span class="font-bold">{{ isset($user) ? $user->email : optional( auth()->user() )->email }}</span>

                    </div>

                    <form method="POST" action="{{ isset($route) ? $route : route('verify') }}" autocomplete="off" class="w-full flex flex-col justify-center">

                        @csrf

                        <input

                            type="hidden"

                            class="hidden"

                            name="email"

                            id="email"

                            value="{{ isset($user) ? $user->email : optional( auth()->user() )->email }}"

                        />

                        <div id="otp" class="flex flex-row justify-center text-center text-black px-2 mt-5">

                            @component('components.elements.digit', [ 'id' => 'first', 'name' => 'digits[]' ]) @endcomponent

                            @component('components.elements.digit', [ 'id' => 'second', 'name' => 'digits[]' ]) @endcomponent

                            @component('components.elements.digit', [ 'id' => 'third', 'name' => 'digits[]' ]) @endcomponent

                            @component('components.elements.digit', [ 'id' => 'fourth', 'name' => 'digits[]' ]) @endcomponent

                            @component('components.elements.digit', [ 'id' => 'fifth', 'name' => 'digits[]' ]) @endcomponent

                            @component('components.elements.digit', [ 'id' => 'sixth', 'name' => 'digits[]' ]) @endcomponent

                        </div>

                        <div class="flex justify-center">

                            @if(isset($messageBag))
                                @component('components.elements.error', [ 'error' => 'verify', 'messageBag' => $messageBag ]) @endcomponent

                            @else
                                @component('components.elements.error', [ 'error' => 'verify' ]) @endcomponent

                            @endif


                        </div>

                        <div class="flex justify-center text-center gap-4 mt-5">

                            <button type="submit" class="flex items-center text-green-600 dark:text-green-400 hover:text-green-700 cursor-pointer">

                                <span class="font-bold">Verify</span>

                            </button>

                            <a href="{{ route('resend:otp') }}" class="flex items-center text-green-600 dark:text-green-400 hover:text-green-700 cursor-pointer">

                                <span class="font-bold">Resend OTP</span>

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection

@push('script')

    <script>

        document.addEventListener("DOMContentLoaded", function(event) {

            function OTPInput() {

                const inputs = document.querySelectorAll('#otp > input[id]');

                inputs.forEach((input, index) => {

                    input.addEventListener('keydown', function(event) {

                        if (event.key === "Backspace") {

                            input.value = '';

                            if (index > 0) inputs[index - 1].focus();

                        } else if (/[0-9a-zA-Z]/.test(event.key)) {

                            input.value = event.key.toUpperCase();

                            if (index < inputs.length - 1) inputs[index + 1].focus();

                            event.preventDefault();

                        }

                    });

                });

            }

            OTPInput();

        });

    </script>

@endpush
