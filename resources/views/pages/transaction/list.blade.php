@extends('layouts.app')

@section('content')

<div class="flex flex-col text-center w-full my-14 text-black dark:text-white">

    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4">{{ __('Transactions') }}</h1>

    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">

        {{ __('Transactions of the system usres based on product purchase and subscriptions.') }}

    </p>

</div>

<div class="flex flex-col justify-center text-gray-600 dark:text-gray-400 m-4">
    <div class="w-full max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <div class="p-2">
            <div class="overflow-x-auto h-[500px] overflow-y-auto no-scrollbar">
                <table class="table-auto w-full">
                    <thead class="text-sm font-semibold uppercase text-gray-400 dark:text-gray-500">
                        <tr>
                            <th class="p-4 whitespace-nowrap">
                                <div class="font-semibold text-left">User</div>
                            </th>
                            <th class="p-4 whitespace-nowrap">
                                <div class="font-semibold text-left">Purchase</div>
                            </th>
                            <th class="p-4 whitespace-nowrap">
                                <div class="font-semibold text-left">Amount</div>
                            </th>
                            <th class="p-4 whitespace-nowrap">
                                <div class="font-semibold text-center">Type</div>
                            </th>
                            <th class="p-4 whitespace-nowrap">
                                <div class="font-semibold text-center">Created At</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="p-4 whitespace-nowrap">
                                    <div class="flex justify-center items-center">
                                        @php($avatar = Avatar::create($transaction->user->full_name)->toBase64())
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 mt-2 sm:mr-3"><img class="rounded-full" src="{{ $avatar }}" width="30" height="30" alt="{{ $transaction->user->full_name }}"></div>
                                        <div class="text-sm text-gray-800 dark:text-gray-200">{{ $transaction->user->full_name }}</div>
                                    </div>
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="text-sm text-center">
                                        <span class="bg-green-600 dark:bg-green-700 p-2 text-white rounded-lg">
                                            {{ $transaction->plan->product_name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="text-left text-sm text-green-500">${{ $transaction->amount/100 }}</div>
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="text-sm text-center">
                                        <span class="bg-green-600 dark:bg-green-700 p-2 text-white rounded-lg">
                                            {{ ucfirst($transaction->type->value) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    <div class="text-sm text-center">{{ $transaction->created_at->format('Y-m-d H:i:s') }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
