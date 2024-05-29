@props([

    'name' => null,

    'placeholder' => null,

    'error' => null,

    'options' => [],

    'selected' => null,

])

<div class="mb-4">

    <div class="mb-1">

        <select

            class="w-full p-3 rounded border placeholder-gray-400 focus:outline-none focus:border-blue-600 dark:placeholder-gray-500 dark:focus:border-blue-400 dark:bg-gray-800 dark:text-white"

            name="{{ $name }}"

        >

            <option>{{ $placeholder }}</option>

            @foreach ($options as $key => $option)

                <option

                    value="{{ $option }}"

                    {{ $option === $selected ? 'selected' : null }}

                >

                    {{ $key . ' (+' . str_replace('+' , '', $option) . ')' }}

                </option>

            @endforeach

        </select>

    </div>

</div>
