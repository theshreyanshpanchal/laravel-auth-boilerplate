@extends('layouts.guest')

@section('content')

<div class="bg-gradient-to-tr from-green-300 to-green-600 dark:from-green-700 dark:to-green-800 h-screen w-full flex justify-center items-center">

    <div>

        <div class="relative p-8 bg-gray-800 rounded">

            <span class="bg-red-500 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">CURRENT</span>

            <div class="mb-4 text-center">

                <p class="text-xl font-medium tracking-wide text-white"> {{ $plan->product_name }} </p>

                <div class="flex items-center justify-center">

                    <p class="mr-2 text-5xl font-semibold text-white lg:text-5xl"> ${{ $plan->amount / 100 }} </p>

                    <p class="text-lg text-gray-500">{{ ' / Every ' . $plan->interval_count . ' ' . $plan->interval }}</p>

                </div>

            </div>

            <ul class="mb-8 space-y-2">

                <li class="flex items-center">

                    <div class="mr-3">

                        <svg class="w-4 h-4 text-teal-accent-400" viewBox="0 0 24 24" stroke-linecap="round" stroke-width="2">

                            <polyline fill="none" stroke="currentColor" points="6,12 10,16 18,8"></polyline>

                            <circle cx="12" cy="12" fill="none" r="11" stroke="currentColor"></circle>

                        </svg>

                    </div>

                    <p class="font-medium text-gray-300">{{ __('Subscription benefit') }}</p>

                </li>

                <li class="flex items-center">

                    <div class="mr-3">

                        <svg class="w-4 h-4 text-teal-accent-400" viewBox="0 0 24 24" stroke-linecap="round" stroke-width="2">

                            <polyline fill="none" stroke="currentColor" points="6,12 10,16 18,8"></polyline>

                            <circle cx="12" cy="12" fill="none" r="11" stroke="currentColor"></circle>

                        </svg>

                    </div>

                    <p class="font-medium text-gray-300">{{ __('Subscription benefit') }}</p>

                </li>

                <li class="flex items-center">

                    <div class="mr-3">

                        <svg class="w-4 h-4 text-teal-accent-400" viewBox="0 0 24 24" stroke-linecap="round" stroke-width="2">

                            <polyline fill="none" stroke="currentColor" points="6,12 10,16 18,8"></polyline>

                            <circle cx="12" cy="12" fill="none" r="11" stroke="currentColor"></circle>

                        </svg>

                    </div>

                    <p class="font-medium text-gray-300">{{ __('Subscription benefit') }}</p>

                </li>

                <li class="flex items-center">

                    <div class="mr-3">

                        <svg class="w-4 h-4 text-teal-accent-400" viewBox="0 0 24 24" stroke-linecap="round" stroke-width="2">

                            <polyline fill="none" stroke="currentColor" points="6,12 10,16 18,8"></polyline>

                            <circle cx="12" cy="12" fill="none" r="11" stroke="currentColor"></circle>

                        </svg>

                    </div>

                    <p class="font-medium text-gray-300">{{ __('Subscription benefit') }}</p>

                </li>
            </ul>

        </div>

        <div class="w-11/12 h-2 mx-auto bg-gray-700 rounded-b opacity-75"></div>

        <div class="w-10/12 h-2 mx-auto bg-gray-700 rounded-b opacity-50"></div>

        <div class="w-9/12 h-2 mx-auto bg-gray-700 rounded-b opacity-25"></div>

    </div>

</div>

@endsection
