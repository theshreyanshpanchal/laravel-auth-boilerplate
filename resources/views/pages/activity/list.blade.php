@extends('layouts.app')

@section('content')

<section class="text-black dark:text-white body-font">

    <div class="flex flex-col text-center w-full my-14">

        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4">{{ __('System Users Activities') }}</h1>

        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">

            {{ __('Tracked activities of the system usres.') }}

        </p>

    </div>


    <div class="container px-5 mx-auto h-[500px]">

        <div class="overflow-y-auto h-full no-scrollbar">

            @foreach ($activities as $index => $activity)

            <div class="flex relative pt-4 pb-4 sm:items-center md:w-2/3 mx-auto">

                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">

                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>

                    </div>

                    <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-green-600 dark:bg-green-800 text-white relative z-10 title-font font-medium text-sm">{{ $index + 1 }}</div>

                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">

                        <div class="flex-shrink-0 w-9 h-9 text-green-600 dark:text-green-800 inline-flex items-center justify-center">

                            @if($activity->type === \App\Enums\ActivityType::LOGGED_IN)

                                <img src="{{ asset('svgs/sidebar/login.svg') }}" alt="logged-in">

                            @endif

                            @if($activity->type === \App\Enums\ActivityType::LOGGED_OUT)

                                <img src="{{ asset('svgs/sidebar/logout.svg') }}" alt="logged-out">

                            @endif

                            @if($activity->type === \App\Enums\ActivityType::LOCKED_OUT)

                                <img src="{{ asset('svgs/sidebar/lockout.svg') }}" alt="locked-out">

                            @endif

                            @if($activity->type === \App\Enums\ActivityType::REGISTERED)

                                <img src="{{ asset('svgs/sidebar/register.svg') }}" alt="registered">

                            @endif

                            @if($activity->type === \App\Enums\ActivityType::VERIFIED)

                                <img src="{{ asset('svgs/sidebar/verify.svg') }}" alt="verified">

                            @endif

                            @if($activity->type === \App\Enums\ActivityType::PASSWORD_RESET)

                                <img src="{{ asset('svgs/sidebar/reset.svg') }}" alt="password-reset">

                            @endif

                        </div>

                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">

                            <h2 class="font-medium title-font text-green-600 dark:text-green-800 mb-1 text-xl">

                                {{ str_replace('-', ' ', ucfirst($activity->type->value)) }}

                            </h2>

                            @php($activityUser = $activity->user->full_name)

                            @php($name = $activityUser === auth()->user()->full_name ? 'You' : $activityUser)

                            <p class="leading-relaxed">{{ __('Time: ') }}{{ $activity->created_at->format('Y-m-d H:i:s') }}</p>

                            <p class="leading-relaxed">{{ __($activity->description, ['user' => $name]) }}</p>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection
