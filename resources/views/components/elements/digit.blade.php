@props([

    'id' => null,

    'name' => null,

    'maxlength' => "1",

])

<input

    class="m-2 border h-10 w-10 text-center form-control rounded"

    type="text"

    id="{{ $id }}"

    name="{{ $name }}"

    maxlength="{{ $maxlength }}"

/>
