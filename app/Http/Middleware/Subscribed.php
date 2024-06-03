<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Subscribed
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->roles->first()->name === UserRole::ADMIN->value) {

            return redirect('dashboard');

        }
        
        if ($user->subscriptions->count()) {

            return $next($request);

        }

        return redirect('subscription');
    }
}
