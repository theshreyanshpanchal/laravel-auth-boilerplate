@extends('layouts.app')

@section('content')

@if ($isAdmin)

    <section class="text-black dark:text-white body-font">

        <div class="container px-5 py-10 mx-auto">

            <div class="flex flex-wrap -m-4 text-center">

                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">

                    <div class="border-2 border-green-600 dark:border-green-800 px-4 py-2 rounded-lg">

                        <div class="flex justify-center">

                            <img class="w-16" src="{{ asset('svgs/sidebar/admin.svg') }}" alt="">

                        </div>

                        <h2 class="title-font font-medium text-3xl text-black dark:text-white">{{ $admins }}</h2>

                        <p class="leading-relaxed">{{ __('Admins') }}</p>

                    </div>

                </div>

                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">

                    <div class="border-2 border-green-600 dark:border-green-800 px-4 py-2 rounded-lg">

                        <div class="flex justify-center">

                            <img class="w-16" src="{{ asset('svgs/sidebar/users.svg') }}" alt="">

                        </div>

                        <h2 class="title-font font-medium text-3xl text-black dark:text-white">{{ $users }}</h2>

                        <p class="leading-relaxed">{{ __('Users') }}</p>

                    </div>

                </div>

                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">

                    <div class="border-2 border-green-600 dark:border-green-800 px-4 py-2 rounded-lg">

                        <div class="flex justify-center">

                            <img class="w-16" src="{{ asset('svgs/sidebar/roles.svg') }}" alt="">

                        </div>

                        <h2 class="title-font font-medium text-3xl text-black dark:text-white">{{ $roles }}</h2>

                        <p class="leading-relaxed">{{ __('Roles') }}</p>

                    </div>

                </div>

                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">

                    <div class="border-2 border-green-600 dark:border-green-800 px-4 py-2 rounded-lg">

                        <div class="flex justify-center">

                            <img class="w-16" src="{{ asset('svgs/sidebar/role-permission.svg') }}" alt="">

                        </div>

                        <h2 class="title-font font-medium text-3xl text-black dark:text-white">{{ $permissions }}</h2>

                        <p class="leading-relaxed">{{ __('Permissions') }}</p>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endif

@endsection
