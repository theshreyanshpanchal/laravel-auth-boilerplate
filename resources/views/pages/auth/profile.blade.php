@extends('layouts.app')

@section('content')

<div class="relative max-w-md mx-auto md:max-w-2xl mt-24 min-w-0 break-words bg-white dark:bg-gray-800 w-full mb-6 shadow-lg rounded-xl">

    <div class="px-6">

        <div class="flex flex-wrap justify-center">

            <div class="w-full flex justify-center">

                <div class="relative">

                    @php($avatar = Avatar::create(auth()->user()->full_name)->toBase64())

                    <img src="{{ $avatar }}" alt="Avatar" class="shadow-xl rounded-full align-middle border-4 border-green-600 dark:border-green-800 absolute -m-16 -ml-20 lg:-ml-16 min-w-[150px]"/>

                </div>

            </div>

        </div>

        <div class="text-center mt-24">

            <h3 class="text-2xl text-green-600 dark:text-green-800 font-bold leading-normal mb-1">{{ auth()->user()->full_name }}</h3>

            <div class="text-xs mt-0 mb-2 font-bold text-black dark:text-white">

                <i class="fas fa-map-marker-alt mr-2 opacity-75"></i>{{ auth()->user()->email }}

            </div>

        </div>

        <div class="mt-6 py-6 border-t border-slate-200 text-center text-black dark:text-white">

            <div class="flex flex-wrap justify-center">

                <form method="POST" action="{{ route('profile') }}" autocomplete="off" class="w-full flex flex-col justify-center">

                    @csrf

                    @component('components.elements.input', [

                        'name' => 'first_name',

                        'placeholder' => 'First name',

                        'autocomplete' => 'off',

                        'value' => auth()->user()->first_name,

                        'error' => 'first_name'
                    ])

                    @endcomponent

                    @component('components.elements.input', [

                        'name' => 'last_name',

                        'placeholder' => 'Last name',

                        'autocomplete' => 'off',

                        'value' => auth()->user()->last_name,

                        'error' => 'last_name'
                    ])

                    @endcomponent

                    @component('components.elements.input', [

                        'type' => 'email',

                        'name' => 'email',

                        'placeholder' => 'Email',

                        'autocomplete' => 'off',

                        'value' => auth()->user()->email,

                        'error' => 'email',

                        'disabled' => true,
                    ])

                    @endcomponent

                    @component('components.elements.select', [

                        'name' => 'phone_number_country_code',

                        'placeholder' => 'Select country code',

                        'options' => $countryCodes ?? [],

                        'error' => 'phone_number_country_code',

                        'selected' => auth()->user()->phone_number_country_code
                    ])

                    @endcomponent

                    @component('components.elements.input', [

                        'type' => 'number',

                        'name' => 'phone_number',

                        'placeholder' => 'Phone number',

                        'autocomplete' => 'off',

                        'value' => auth()->user()->phone_number,

                        'error' => 'phone_number'
                    ])

                    @endcomponent

                    <button type="submit" class="bg-green-600 dark:bg-green-700 font-bold text-white focus:outline-none rounded p-3 cursor-pointer mt-1">

                        {{ __('Save') }}

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
