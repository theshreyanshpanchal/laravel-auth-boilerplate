@props([

    'name' => null,

    'value' => null,

    'title' => null,

    'description' => null,

    'checked' => false,

    'width' => 'w-8',

    'height' => 'h-8',

    'padding' => 'p-5',

    'text' => ''

])

<div class="flex items-start space-x-2 {{ $padding }}">

    <input

        type="checkbox"

        name="{{ $name }}"

        value="{{ $value }}"

        class="mt-1 accent-green-600 dark:accent-green-800 {{ $width }} {{ $height }}"

        {{ $checked ? 'checked' : null }}

    >

    <div class="flex flex-col">

        <label for="big-checkbox" class="font-medium {{ $text }}">{{ $title }}</label>

        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $description }}</span>

    </div>

</div>
