@extends('layouts.app')

@section('content')

<section class="text-black dark:text-white body-font">

    <div class="container px-5 py-24 mx-auto">

        <div class="flex flex-col text-center w-full mb-20">

            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4">{{ __('System Permissions') }}</h1>

            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">

                {{ __('Set of permissions granted to users, determining access level within the system.') }}

            </p>

        </div>

        <form method="POST" action="{{ route('sync:role-permissions', $role->id ) }}" autocomplete="off">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

                @csrf

                @php($rolePermissions = $role->permissions->pluck('name')->toArray())

                @foreach ($permissions as $permission)

                    @component('components.elements.checkbox', [

                        'name' => 'permissions[]',

                        'value' => $permission->name,

                        'title' => $permission->display_name,

                        'description' => $permission->description,

                        'checked' => in_array($permission->name, $rolePermissions)

                    ]) @endcomponent

                @endforeach

            </div>

            <div class="flex justify-center mt-2">

                <button type="submit" class="bg-green-600 dark:bg-green-700 font-bold text-white focus:outline-none rounded p-3 cursor-pointer mt-1">

                    {{ __('Update Permissions') }}

                </button>

            </div>

        </form>

    </div>

  </section>

@endsection
