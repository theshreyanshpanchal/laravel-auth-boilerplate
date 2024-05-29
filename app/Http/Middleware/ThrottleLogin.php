<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class ThrottleLogin
{
    protected $maxAttempts = 3;

    protected $lockoutTimeInSeconds = 120;

    public function handle($request, Closure $next)
    {
        $email = $request->input('email');

        $key = 'login_attempts_' . $email;

        if (Cache::has($key) && Cache::get($key) >= $this->maxAttempts) {

            $remainingLockoutTime = Cache::get($key . '_time') - time();

            $message = 'Too many login attempts. Please try again in ' . ceil($remainingLockoutTime / 60) . ' minutes.';

            return redirect("login")->withErrors([ 'email-or-password' => $message ]);
        }

        return $next($request);
    }

    public function incrementAttempts($email)
    {
        $key = 'login_attempts_' . $email;

        if (Cache::has($key)) {

            Cache::increment($key);

        } else {

            Cache::put($key, 1, $this->lockoutTimeInSeconds);

        }

        if (Cache::get($key) >= $this->maxAttempts) {

            Cache::put($key . '_time', time() + $this->lockoutTimeInSeconds, $this->lockoutTimeInSeconds);

        }
    }

    public function clearAttempts($email)
    {
        Cache::forget('login_attempts_' . $email);

        Cache::forget('login_attempts_' . $email . '_time');
    }
}
