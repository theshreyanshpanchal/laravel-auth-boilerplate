<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $route = Route::currentRouteName();

        if ($route === 'login') {

            return [

                'email' => 'required|string|email|max:100|exists:users,email,deleted_at,NULL',

                'password' => 'required|min:6',

                'remember' => 'nullable|sometimes|boolean'

            ];
        }

        if ($route === 'register') {

            return [

                'first_name' => 'required|min:3|max:100',

                'last_name' => 'required|min:3|max:100',

                'email' => 'required|string|email|max:100|unique:users,email,NULL,id,deleted_at,NULL',

                'password' => 'required|min:6',

            ];
        }

        if ($route === 'send:reset-password-otp') {

            return [

                'email' => 'required|string|email|max:100|exists:users,email,deleted_at,NULL',

            ];
        }

        if ($route === 'verify:reset-password-otp') {

            return [

                'digits' => 'required|array|min:6|max:6',

                'email' => 'required|string|email|max:100|exists:users,email,deleted_at,NULL',

            ];
        }

        if ($route === 'verify') {

            return [

                'digits' => 'required|array|min:6|max:6',

            ];
        }

        if ($route === 'reset-password') {

            return [

                'email' => 'required|string|email|max:100|exists:users,email,deleted_at,NULL',

                'password' => 'required|min:6',

            ];
        }

        if ($route === 'change-password') {

            return [

                'email' => 'required|string|email|max:100|exists:users,email,deleted_at,NULL',

                'old_password' => 'required|min:6',

                'new_password' => 'required|min:6',

                'confirm_new_password' => 'required_with:new_password|same:new_password|min:6',

            ];
        }

        if ($route === 'profile') {

            return [

                'first_name' => 'required|min:3|max:100',

                'last_name' => 'required|min:3|max:100',

                'phone_number' => 'nullable|sometimes|max:25|unique:users,phone_number,' . auth()->user()->id . ',id,deleted_at,NULL',

                'phone_number_country_code' => 'nullable|sometimes',

            ];
        }

        return [];
    }
}
