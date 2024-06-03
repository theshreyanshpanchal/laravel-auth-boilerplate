@extends('layouts.app')

@section('content')

<div class="relative max-w-md mx-auto md:max-w-2xl mt-24 min-w-0 break-words bg-white dark:bg-gray-800 w-full mb-6 shadow-lg rounded-xl">

    <div class="px-6">

        <div class="mt-6 py-6 text-center text-black dark:text-white">

            <div class="flex flex-wrap justify-center">

                <form method="POST" action="{{ route('change-password') }}" autocomplete="off" class="w-full flex flex-col justify-center">

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

                        'name' => 'old_password',

                        'placeholder' => 'Old password',

                        'autocomplete' => 'off',

                        'error' => 'old_password'
                    ])

                    @endcomponent

                    @component('components.elements.input', [

                        'type' => 'password',

                        'name' => 'new_password',

                        'placeholder' => 'New password',

                        'autocomplete' => 'off',

                        'error' => 'new_password'
                    ])

                    @endcomponent

                    @component('components.elements.input', [

                        'type' => 'password',

                        'name' => 'confirm_new_password',

                        'placeholder' => 'Confirm new password',

                        'autocomplete' => 'off',

                        'error' => 'confirm_new_password'
                    ])

                    @endcomponent

                    @component('components.elements.error', [ 'error' => 'change-password' ]) @endcomponent

                    <button type="submit" class="bg-green-600 dark:bg-green-700 font-bold text-white focus:outline-none rounded p-3 cursor-pointer mt-2">

                        {{ __('Change Password') }}

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
