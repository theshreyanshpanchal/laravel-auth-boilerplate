@extends('layouts.guest')

@section('content')

<div class="bg-gradient-to-tr from-green-300 to-green-600 dark:from-green-900 dark:to-green-800 h-screen w-full flex justify-center items-center">

    <div class="bg-green-600 dark:bg-green-800 w-full sm:w-1/2 md:w-9/12 lg:w-1/2 shadow-md flex flex-col md:flex-row items-center mx-5 sm:m-0 rounded-xl">

        <div class="w-full md:w-1/2 hidden md:flex flex-col justify-center items-center text-white rounded-l-xl md:rounded-r-none">

            <h1 class="text-3xl">{{ __('Hello') }}</h1>

            <p class="text-5xl font-extrabold">{{ __('Welcome!') }}</p>

        </div>

        <div class="bg-white dark:bg-gray-900 w-full md:w-1/2 flex flex-col items-center py-32 px-8 rounded-r-xl md:rounded-l-none">

            <div class="py-1">

                @component('components.elements.success') @endcomponent

            </div>

            <h3 class="text-3xl font-bold text-green-600 dark:text-green-400 mb-4">

                {{ __('RESET PASSWORD') }}

            </h3>

            <form method="POST" action="{{ route('reset-password') }}" autocomplete="off" class="w-full flex flex-col justify-center">

                @csrf

                <input

                    type="hidden"

                    class="hidden"

                    name="email"

                    id="email"

                    value="{{ isset($user) ? $user->email : optional( auth()->user() )->email }}"

                />

                @component('components.elements.input', [

                    'type' => 'password',

                    'name' => 'password',

                    'placeholder' => 'Password',

                    'autocomplete' => 'off',

                    'error' => 'password'
                ])

                @endcomponent

                <button type="submit" class="bg-green-600 dark:bg-green-700 font-bold text-white focus:outline-none rounded p-3 cursor-pointer mt-1">

                    {{ __('Reset') }}

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
