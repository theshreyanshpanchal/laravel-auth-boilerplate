@extends('layouts.guest')

@section('content')

<style>

    .StripeElement {

        background-color: white;

        padding: 12px;

        border-radius: 8px;

        border: 1px solid #ccd0d2;

        box-shadow: 0 2px 3px 0 rgba(0,0,0,0.1);

        transition: box-shadow 150ms ease, border-color 150ms ease;

    }

    .StripeElement--focus {

        box-shadow: 0 2px 3px 0 rgba(0,0,0,0.2);

        border-color: #5b9bd5;

    }

    .StripeElement--invalid {

        border-color: #e75151;

    }

    .StripeElement--webkit-autofill {

        background-color: #fefde5 !important;

    }

    .credit-card-wrapper {

        max-width: 400px;

        margin: 0 auto;

    }

</style>

<div class="relative w-full h-screen bg-white dark:bg-gray-900">

    <div class="absolute hidden w-full bg-green-600 dark:bg-green-700 lg:block h-96"></div>

    <div class="relative px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">

        <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">

            <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-white sm:text-4xl md:mx-auto">

                <span class="relative inline-block">

                    <svg viewBox="0 0 52 24" fill="currentColor" class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-white lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">

                        <defs>

                            <pattern id="2c67e949-4a23-49f7-bf27-ca140852cf21" x="0" y="0" width=".135" height=".30">

                                <circle cx="1" cy="1" r=".7"></circle>

                            </pattern>

                        </defs>

                        <rect fill="url(#2c67e949-4a23-49f7-bf27-ca140852cf21)" width="52" height="24"></rect>

                    </svg>

                    <span class="relative">{{ __('Affordable') }}</span>

                </span>

                {{ __('for everyone') }}

            </h2>

            <p class="text-base text-white md:text-lg">

                {{ __('Subscriptions let you collect recurring payments for products with any pricing model.') }}

            </p>

        </div>

        <form action="/subscription" method="POST" id="subscribe-form" class="mt-10">

            @csrf

            <div class="grid gap-10 md:grid-cols-3 sm:mx-auto">

                @foreach ($plans as $plan)

                <div>

                    <div class="p-8 bg-gray-800 rounded">

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

                        <input type="radio" id="plan-{{ $plan->plan_id }}" name="plan" value="{{ $plan->plan_id }}" class="hidden plan-radio">

                        <label for="plan-{{ $plan->plan_id }}" class="block mt-4 p-2 text-center text-sm text-white bg-teal-600 rounded cursor-pointer select-button hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">{{ __('Select') }}</label>

                    </div>

                    <div class="w-11/12 h-2 mx-auto bg-gray-700 rounded-b opacity-75"></div>

                    <div class="w-10/12 h-2 mx-auto bg-gray-700 rounded-b opacity-50"></div>

                    <div class="w-9/12 h-2 mx-auto bg-gray-700 rounded-b opacity-25"></div>

                </div>

                @endforeach

            </div>


            <div class="credit-card-wrapper">

                <div class="mb-4 mt-5">

                    <label for="card-holder-name" class="block mb-2 text-black dark:text-white">{{ __('Card Holder Name') }}</label>

                    <input id="card-holder-name" type="text" class="w-full p-2 border border-gray-300 rounded">

                </div>

                <div class="form-row mb-4">

                    <label for="card-element" class="block mb-2 text-black dark:text-white">{{ __('Credit or debit card') }}</label>

                    <div id="card-element" class="StripeElement mb-2"></div>

                    <div id="card-errors" role="alert" class="text-red-600 mt-2"></div>

                </div>

                @if (count($errors) > 0)

                <div class="alert alert-danger">

                    @foreach ($errors->all() as $error)

                    <div class="text-red-600">{{ $error }}</div>

                    @endforeach

                </div>

                @endif

                <div class="form-group text-center">

                    <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-lg btn-success w-full bg-green-600 text-white py-2 rounded">{{ __('Subscribe') }}</button>

                </div>

            </div>

        </form>

    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>

    document.querySelectorAll('.select-button').forEach(button => {

        button.addEventListener('click', function() {

            document.querySelectorAll('.plan-radio').forEach(radio => {

                if (radio.checked) {

                    radio.checked = false;

                    radio.nextElementSibling.classList.remove('bg-teal-800');

                }

            });

            const radioInput = this.previousElementSibling;

            radioInput.checked = true;

            this.classList.add('bg-teal-800');

        });

    });

    var stripe = Stripe('{{ env('STRIPE_KEY') }}');

    var elements = stripe.elements();

    var style = {

        base: {

            color: '#32325d',

            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',

            fontSmoothing: 'antialiased',

            fontSize: '16px',

            '::placeholder': {

                color: '#aab7c4'

            }

        },

        invalid: {

            color: '#fa755a',

            iconColor: '#fa755a'

        }

    };

    var card = elements.create('card', {hidePostalCode: true, style: style});

    card.mount('#card-element');

    card.addEventListener('change', function(event) {

        var displayError = document.getElementById('card-errors');

        if (event.error) {

            displayError.textContent = event.error.message;

        } else {

            displayError.textContent = '';
        }

    });

    const cardHolderName = document.getElementById('card-holder-name');

    const cardButton = document.getElementById('card-button');

    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {

        e.preventDefault();

        const { setupIntent, error } = await stripe.confirmCardSetup(

            clientSecret, {

                payment_method: {

                    card: card,

                    billing_details: { name: cardHolderName.value }

                }

            }
        );

        if (error) {

            var errorElement = document.getElementById('card-errors');

            errorElement.textContent = error.message;

        } else {

            paymentMethodHandler(setupIntent.payment_method);

        }

    });

    function paymentMethodHandler(payment_method) {

        var form = document.getElementById('subscribe-form');

        var hiddenInput = document.createElement('input');

        hiddenInput.setAttribute('type', 'hidden');

        hiddenInput.setAttribute('name', 'payment_method');

        hiddenInput.setAttribute('value', payment_method);

        form.appendChild(hiddenInput);

        form.submit();

    }

</script>

@endsection
