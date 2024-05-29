<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = Auth::user();

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        if ($user->hasAnyDirectPermission($permissions) || $user->hasRole(UserRole::ADMIN->name)) {

            return $next($request);

        };

        $message = 'You doesn\'t have correct permission.';

        return redirect("dashboard")->withErrors([ 'role-&-permission' => $message ]);
    }
}
