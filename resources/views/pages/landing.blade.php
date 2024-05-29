@extends('layouts.guest')

@section('content')

    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 dark:border-red-500">

        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" />

        <div class="relative min-h-screen flex flex-col items-center justify-center">

            <div class="relative w-full max-w-2xl px-4 lg:max-w-7xl">

                <div class="grid grid-cols-2 items-center gap-2 lg:grid-cols-3">

                    <div class="flex lg:justify-center lg:col-start-2 gap-4 mt-4">

                        <img src="{{ asset('svgs/landing/door-lock.svg') }}" alt="Lock">

                    </div>

                </div>

                <main class="mt-2 py-4">

                    <section class="text-gray-600 body-font">

                        <div class="container px-4 py-4 mx-auto">

                            <div class="flex flex-wrap -m-4">

                                <div class="lg:w-1/3 sm:w-1/2 p-4">

                                    <div class="flex relative">

                                        <img alt="Register" class="absolute inset-0 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-28 h-28 object-center" src="{{ asset('images/landing/register.png') }}">

                                        <div class="px-8 py-10 relative z-10 w-full border-4 rounded-xl shadow-sm border-gray-200 bg-white dark:bg-black dark:text-white/50 dark:border-red-500 opacity-0 hover:opacity-100">

                                            <h2 class="tracking-widest text-sm title-font font-medium text-red-500 mb-1">{{ __('REGISTER') }}</h2>

                                            <h1 class="title-font text-lg font-medium text-gray-900 dark:text-white mb-3">{{ __('User Registration') }}</h1>

                                            <p class="leading-relaxed">{{ __('This functionality allows users to create a new account on a platform or application. Registration involves email verification too.') }}</p>

                                        </div>

                                    </div>

                                </div>

                                <div class="lg:w-1/3 sm:w-1/2 p-4">

                                    <div class="flex relative">

                                        <img alt="Login" class="absolute inset-0 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-20 h-20 object-center" src="{{ asset('images/landing/login.png') }}">

                                        <div class="px-8 py-10 relative z-10 w-full border-4 rounded-xl shadow-sm border-gray-200 bg-white dark:bg-black dark:text-white/50 dark:border-red-500 opacity-0 hover:opacity-100">

                                            <h2 class="tracking-widest text-sm title-font font-medium text-red-500 mb-1">{{ __('LOGIN') }}</h2>

                                            <h1 class="title-font text-lg font-medium text-gray-900 dark:text-white mb-3">{{ __('User Login') }}</h1>

                                            <p class="leading-relaxed">{{ __('Login enables users to access their accounts by providing their credentials, usually a combination of username/email and password.') }}</p>

                                        </div>

                                    </div>

                                </div>

                                <div class="lg:w-1/3 sm:w-1/2 p-4">

                                    <div class="flex relative">

                                        <img alt="Session" class="absolute inset-0 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-20 h-20 object-center" src="{{ asset('images/landing/session.png') }}">

                                        <div class="px-8 py-10 relative z-10 w-full border-4 rounded-xl shadow-sm border-gray-200 bg-white dark:bg-black dark:text-white/50 dark:border-red-500 opacity-0 hover:opacity-100">

                                            <h2 class="tracking-widest text-sm title-font font-medium text-red-500 mb-1">{{ __('SESSION') }}</h2>

                                            <h1 class="title-font text-lg font-medium text-gray-900 dark:text-white mb-3">{{ __('User Sessions Management') }}</h1>

                                            <p class="leading-relaxed">{{ __('Users can view a list of their active sessions and log out of sessions remotely to enhance security and manage their account\'s accessibility effectively.') }}</p>

                                        </div>

                                    </div>

                                </div>

                                <div class="lg:w-1/3 sm:w-1/2 p-4">

                                    <div class="flex relative">

                                        <img alt="Profile" class="absolute inset-0 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-24 h-24 object-center" src="{{ asset('images/landing/profile.png') }}">

                                        <div class="px-8 py-10 relative z-10 w-full border-4 rounded-xl shadow-sm border-gray-200 bg-white dark:bg-black dark:text-white/50 dark:border-red-500 opacity-0 hover:opacity-100">

                                            <h2 class="tracking-widest text-sm title-font font-medium text-red-500 mb-1">{{ __('PROFILE') }}</h2>

                                            <h1 class="title-font text-lg font-medium text-gray-900 dark:text-white mb-3">{{ __('User Profile Management') }}</h1>

                                            <p class="leading-relaxed">{{ __('Profile management empowers users to update and maintain their personal information and preferences within the platform or application.') }}</p>

                                        </div>

                                    </div>

                                </div>

                                <div class="lg:w-1/3 sm:w-1/2 p-4">

                                    <div class="flex relative">

                                        <img alt="Role" class="absolute inset-0 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-20 h-20 object-center" src="{{ asset('images/landing/role-permission.png') }}">

                                        <div class="px-8 py-10 relative z-10 w-full border-4 rounded-xl shadow-sm border-gray-200 bg-white dark:bg-black dark:text-white/50 dark:border-red-500 opacity-0 hover:opacity-100">

                                            <h2 class="tracking-widest text-sm title-font font-medium text-red-500 mb-1">{{ __('ROLES') }}</h2>

                                            <h1 class="title-font text-lg font-medium text-gray-900 dark:text-white mb-3">{{ __('User Role Management') }}</h1>

                                            <p class="leading-relaxed">{{ __('Role permissions management is essential for controlling access to different features and data within the platform based on user roles.') }}</p>

                                        </div>

                                    </div>

                                </div>

                                <div class="lg:w-1/3 sm:w-1/2 p-4">

                                    <div class="flex relative">

                                        <img alt="2fa" class="absolute inset-0 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-20 h-20 object-center" src="{{ asset('images/landing/2fa.png') }}">

                                        <div class="px-8 py-10 relative z-10 w-full border-4 rounded-xl shadow-sm border-gray-200 bg-white dark:bg-black dark:text-white/50 dark:border-red-500 opacity-0 hover:opacity-100">

                                            <h2 class="tracking-widest text-sm title-font font-medium text-red-500 mb-1">{{ __('2FA') }}</h2>

                                            <h1 class="title-font text-lg font-medium text-gray-900 dark:text-white mb-3">{{ __('Two-Factor Authentication') }}</h1>

                                            <p class="leading-relaxed">{{ __('2FA adds an extra layer of security to the login process by requiring users to provide two forms of authentication before gaining access to their accounts.') }}</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                      </section>

                </main>

                <footer class="py-4 text-center text-sm text-black dark:text-white/70">

                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})

                </footer>

            </div>

        </div>

    </div>

@endsection
