@props([

    'type' => 'text',

    'name' => null,

    'placeholder' => null,

    'autocomplete' => null,

    'error' => null,

    'value' => null,

    'disabled' => false

])

<div class="mb-4">

    <div class="mb-1">

        <input

            type="{{ $type }}"

            name="{{ $name }}"

            placeholder="{{ $placeholder }}"

            autocomplete="{{ $autocomplete }}"

            value="{{ $value }}"

            class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-blue-600 dark:placeholder-gray-500 dark:focus:border-blue-400 dark:bg-gray-800 dark:text-white {{ $disabled ? 'cursor-not-allowed' : null }}"

            {{ $disabled ? 'disabled' : null }}

        />

    </div>

    @component('components.elements.error', [ 'error' => $error ]) @endcomponent

</div>
