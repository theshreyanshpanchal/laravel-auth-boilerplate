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

    @component('components.common.sidebar')

        @slot('content')

            @component('components.common.header') @endcomponent

            <main class="flex-1 pr-4 text-white">

                @component('components.elements.alert-error', ['error' => 'message']) @endcomponent

                @component('components.elements.alert-success') @endcomponent

                @yield('content')

            </main>

        @endslot

    @endcomponent

</body>

</html>
