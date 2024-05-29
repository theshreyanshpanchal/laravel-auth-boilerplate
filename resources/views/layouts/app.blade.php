<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __(config('app.name')) }}</title>

    @component('components.common.favicon') @endcomponent

    @vite('resources/css/app.css')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body>

    <div class="flex bg-white dark:bg-gray-900 h-screen" x-data="{ isExpanded: true }">

        <aside class="flex flex-col text-gray-300 bg-gradient-to-tr from-green-500 to-green-600 dark:from-green-900 dark:to-green-700 transition-all duration-300 ease-in-out m-4 rounded-xl" :class="isExpanded ? 'w-64' : 'w-20'">

            <a href="#" class="h-20 flex items-center px-4 hover:text-gray-100 hover:bg-opacity-50 focus:outline-none focus:text-gray-100 focus:bg-opacity-50 overflow-hidden rounded-xl">

                <img class="w-12" src="{{ asset('svgs/sidebar/logo.svg') }}" alt="Logo">

                <span class="ml-2 text-xl font-medium duration-300 ease-in-out" :class="isExpanded ? 'opacity-100' : 'opacity-0'">{{ __('Laravel Auth') }}</span>

            </a>

            <nav class="p-4 space-y-2 font-medium">

                @can('dashboard')

                    <a href="{{ route('dashboard') }}" class="flex items-center h-10 px-3 text-white hover:bg-green-600 @activeRoute('dashboard') rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">

                        <img class="w-8" src="{{ asset('svgs/sidebar/dashboard.svg') }}" alt="Dashboard">

                        <span class="ml-2 duration-300 ease-in-out"

                        :class="isExpanded ? 'opacity-100' : 'opacity-0'">{{ __('Dashboard') }}</span>

                    </a>

                @endcan

                @can('user-list')

                    <a href="{{ route('view:users') }}" class="flex items-center h-10 px-3 text-white hover:bg-green-600 @activeRoute('view:users') rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">

                        <img class="w-8" src="{{ asset('svgs/sidebar/users.svg') }}" alt="Users">

                        <span class="ml-2 duration-300 ease-in-out"

                        :class="isExpanded ? 'opacity-100' : 'opacity-0'">{{ __('Users') }}</span>

                    </a>

                @endcan

                @can('role-permission-list')

                    <a href="{{ route('view:roles') }}" class="flex items-center h-10 px-3 text-white hover:bg-green-600 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">

                        <img class="w-8" src="{{ asset('svgs/sidebar/role-permission.svg') }}" alt="Role & Permission">

                        <span class="ml-2 duration-300 ease-in-out" :class="isExpanded ? 'opacity-100' : 'opacity-0'">{{ __('Role & Permission') }}</span>

                    </a>

                @endcan

                @can('activity-list')

                    <a href="{{ route('view:activities') }}" class="flex items-center h-10 px-3 text-white hover:bg-green-600 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">

                        <img class="w-8" src="{{ asset('svgs/sidebar/activity.svg') }}" alt="Activity">

                        <span class="ml-2 duration-300 ease-in-out" :class="isExpanded ? 'opacity-100' : 'opacity-0'">{{ __('Activity') }}</span>

                    </a>

                @endcan

            </nav>

            <div class="p-4 font-medium mt-auto">

                <a href="{{ route('logout') }}" class="flex items-center h-10 px-3 text-white hover:bg-green-600 hover:bg-opacity-25 rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline">

                    <img class="w-8" src="{{ asset('svgs/sidebar/logout.svg') }}" alt="Logout">

                    <span class="ml-2 duration-300 ease-in-out" :class="isExpanded ? 'opacity-100' : 'opacity-0'">

                        {{ __('Logout') }}

                    </span>

                </a>

            </div>

        </aside>

        <div class="flex-1 flex flex-col">

            @component('components.common.header') @endcomponent

            <main class="flex-1 pr-4 text-white">

                @component('components.elements.alert-error', ['error' => 'role-&-permission']) @endcomponent

                @component('components.elements.alert-success') @endcomponent

                @yield('content')

            </main>

        </div>
    </div>


</body>

</html>
