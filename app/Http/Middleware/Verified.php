<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Verified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $verified = optional($user)->email_verified_at;

        if ( is_null($verified) ) { return redirect('reverify'); }

        return $next($request);
    }
}
