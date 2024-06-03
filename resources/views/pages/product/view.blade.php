@extends('layouts.app')

@section('content')

<section class="text-gray-600 body-font">

    <div class="container px-5 py-14 mx-auto">

        <div class="flex flex-wrap -m-4">

            @foreach ($products as $product)

                <div class="lg:w-1/4 md:w-1/2 p-4 w-full">

                    <a class="block relative h-48 rounded overflow-hidden">

                        <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="https://dummyimage.com/420x260">

                    </a>

                    <div class="mt-4">

                        <h3 class="text-black dark:text-white text-xs tracking-widest title-font mb-1">{{ ucfirst(str_replace('_', ' ', $product->type->value)) . ' purchase' }}</h3>

                        <h2 class="text-black dark:text-white title-font text-lg font-medium">{{ $product->product_name }}</h2>

                        <p class="text-green-500 dark:text-green-700 mt-1 mb-3">

                            {{ __('Price: ') }} ${{ $product->amount/100 }}

                        </p>

                    </div>

                    @if (! (auth()->user()->roles->first()->name === App\Enums\UserRole::ADMIN->value))

                        <a href="{{ route('show:product', $product->plan_id) }}" class="bg-green-600 dark:bg-green-700 font-bold text-white focus:outline-none rounded p-3 cursor-pointer mt-3">

                            @if (in_array($product->product_id, $purchases))

                                {{ __('SHOW') }}

                            @else

                                {{ __('PURCHASE') }}

                            @endif

                        </a>

                    @else

                        <div class="flex -space-x-2 overflow-hidden p-2">

                            @foreach ($product->purchases as $purchase)

                                @php($avatar = Avatar::create($purchase->user->full_name)->toBase64())

                                <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="{{ $avatar }}" alt="{{ $purchase->user->full_name }}">

                            @endforeach

                    </div>

                    @endif

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection
