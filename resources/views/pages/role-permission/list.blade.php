@extends('layouts.app')

@section('content')

<section class="text-black dark:text-white body-font">

    <div class="container px-5 py-24 mx-auto">

        <div class="flex flex-col text-center w-full mb-20">

            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4">{{ __('System Roles and permissions') }}</h1>

            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">

                {{ __('System roles define the set of permissions granted to users, determining their access level and actions they can perform within the system.') }}

            </p>

        </div>

        <div class="flex flex-wrap -m-2">

            @foreach ($roles as $role)

                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">

                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">

                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/80x80">

                        <div class="flex-grow">

                            <h2 class="text-black dark:text-white title-font font-medium">{{ $role->display_name }}</h2>

                            <p class="text-gray-500">{{ $role->description }}</p>

                            <a href="{{ route('view:permissions', ['role' => $role->id]) }}">

                                <p class="text-green-600 dark:text-green-800">{{ __('Edit Permissions') }}</p>

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        @if($roles->count() === 0)

                @component('components.elements.empty', ['message' => 'Roles not found in the system.']) @endcomponent

        @endif

    </div>

  </section>

@endsection
