@extends('layouts.app')

@section('content')

<div class="w-full flex justify-center items-center text-black dark:text-white">

    @if (auth()->user()->subscribed())

        {{ __('You are viewing this page because you are subscribed to the our one of plan.') }}

    @endif

</div>

@endsection
