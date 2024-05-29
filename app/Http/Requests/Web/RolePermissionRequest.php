<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class RolePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $route = Route::currentRouteName();

        if ($route === 'sync:role-permissions') {

            return [

                'permissions' => 'array|min:0',

            ];
        }
    }
}
