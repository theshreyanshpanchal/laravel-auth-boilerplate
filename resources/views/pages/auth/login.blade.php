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

                {{ __('LOGIN') }}

            </h3>

            <form method="POST" action="{{ route('login') }}" autocomplete="off" class="w-full flex flex-col justify-center">

                @csrf

                @component('components.elements.input', [

                    'type' => 'email',

                    'name' => 'email',

                    'placeholder' => 'Email',

                    'autocomplete' => 'off',

                    'error' => 'email'
                ])

                @endcomponent

                @component('components.elements.input', [

                    'type' => 'password',

                    'name' => 'password',

                    'placeholder' => 'Password',

                    'autocomplete' => 'off',

                    'error' => 'password'
                ])

                @endcomponent

                @component('components.elements.checkbox', [

                    'name' => 'remember',

                    'value' => true,

                    'title' => 'Remember Me',

                    'description' => '',

                    'width' => 'w-4',

                    'height' => 'h-4',

                    'padding' => 'p-0',

                    'text' => 'text-green-600 dark:text-green-700'

                ]) @endcomponent

                @component('components.elements.error', [ 'error' => 'email-or-password' ]) @endcomponent

                <button type="submit" class="bg-green-600 dark:bg-green-700 font-bold text-white focus:outline-none rounded p-3 cursor-pointer mt-1">

                    {{ __('Login') }}

                </button>

                <div class="flex justify-center text-black text-center dark:text-white mt-2">

                    <span>

                        {{ __('Forgot password?') }}

                        <a href="{{ route('view:reset-password') }}" class="text-green-600 dark:text-green-700 cursor-pointer">{{ __('Reset Password') }}</a>

                    </span>

                </div>

                <div class="flex items-center justify-center space-x-2 text-black text-center dark:text-white my-3">

                    <div class="border-t border-blue-dark w-36 opacity-20"></div>

                    <span class="text-blue-light">OR</span>

                    <div class="border-t border-blue-dark w-36 opacity-20"></div>

                </div>

                <div class="flex justify-center space-x-5">

                    <a href="{{ route('socialite:redirect', \App\Enums\SocialiteLoginType::FACEBOOK) }}">

                        <img src="{{ asset('svgs/social/facebook.svg') }}" alt="facebook" width="28" height="28" />

                    </a>

                    <a href="{{ route('socialite:redirect', \App\Enums\SocialiteLoginType::GOOGLE) }}">

                        <img src="{{ asset('svgs/social/google.svg') }}" alt="google" width="28" height="28" />

                    </a>

                </div>

                <div class="flex justify-center text-black text-center dark:text-white mt-2">

                    <span>

                        {{ __('Don’t have an account?') }}

                        <a href="{{ route('register') }}" class="text-green-600 dark:text-green-700 cursor-pointer">{{ __('Register') }}</a>

                    </span>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
