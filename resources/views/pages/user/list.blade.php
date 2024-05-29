@extends('layouts.app')

@section('content')

<section class="text-black dark:text-white body-font">

    <div class="container px-5 py-24 mx-auto">

        <div class="flex flex-col text-center w-full mb-20">

            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4">{{ __('System Users') }}</h1>

            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">

                {{ __('System Users are accounts created within an operating system to interact with its services, manage resources, or execute processes.') }}

            </p>

        </div>

        <div class="flex flex-wrap -m-2">

            @foreach ($users as $user)

                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">

                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">

                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/80x80">

                        <div class="flex-grow">

                            <h2 class="text-black dark:text-white title-font font-medium">{{ $user->full_name }}</h2>

                            <p class="text-gray-500">{{ $user->email }}</p>

                            <p class="text-gray-500">{{ ucfirst($user->roles->first()->name) }}</p>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        @if($users->count() === 0)

                @component('components.elements.empty', ['message' => 'Users not found in the system.']) @endcomponent

        @endif

    </div>

  </section>

@endsection
