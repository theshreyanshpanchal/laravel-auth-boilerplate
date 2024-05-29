@extends('layouts.markdown')

@section('content')


<div class="container">

    <div class="card">

        <h2>{{ __('One Time Password') }}</h2>

        <p>{{ __('Please use the below six-digit number to verify your account') }}</p>

        <p><strong>{{ $otp }}</strong></p>

        <p>{{ __('OTP is valid for the next 10 minutes. Please do not share it with anyone.') }}</p>

    </div>

</div>

@endsection
