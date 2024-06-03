@extends('layouts.app')

@section('content')

<section class="text-gray-600 body-font">

    <div class="container px-5 py-24 mx-auto">

        <div class="flex flex-wrap -mx-4 -my-8">

            @foreach ($users as $user)

                <div class="py-8 px-4 lg:w-1/3">

                    <div class="h-full flex items-start">

                        <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">

                            <span class="text-black dark:text-white pb-2 mb-2 border-b-2 border-gray-200">{{ $user->subscriptions->first()->created_at->format('M') }}</span>

                            <span class="font-medium text-lg text-black dark:text-white title-font leading-none">{{ $user->subscriptions->first()->created_at->format('d') }}</span>

                        </div>

                        <div class="flex-grow pl-6">

                            <h2 class="tracking-widest text-xs title-font font-medium text-green-500 mb-1">SUBSCRIBER</h2>

                            <h1 class="title-font text-xl font-medium text-black dark:text-white mb-3">{{ ucfirst($user->subscriptions->first()->stripe_status) }}</h1>

                            <a class="inline-flex items-center">

                                <img alt="blog" src="https://dummyimage.com/103x103" class="w-8 h-8 rounded-full flex-shrink-0 object-cover object-center">

                                <span class="flex-grow flex flex-col pl-3">

                                    <span class="title-font font-medium text-black dark:text-white">{{ $user->full_name }}</span>

                                </span>

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection
