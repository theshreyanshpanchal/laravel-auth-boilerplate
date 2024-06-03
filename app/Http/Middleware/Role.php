<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        $roles = is_array($role) ? $role : explode('|', $role);

        if ($user->hasAnyRole($roles)) { return $next($request); }

        $message = 'You doesn\'t have correct roles.';

        return redirect("dashboard")->withErrors([ 'message' => $message ]);
    }
}
