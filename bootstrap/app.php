<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\Guest;
use App\Http\Middleware\NotVerified;
use App\Http\Middleware\Permission;
use App\Http\Middleware\Role;
use App\Http\Middleware\Subscribed;
use App\Http\Middleware\ThrottleLogin;
use App\Http\Middleware\Verified;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'guest' => Guest::class,
            'authenticate' => Authenticate::class,

            'throttle:login' => ThrottleLogin::class,

            'verified' => Verified::class,
            'not-verified' => NotVerified::class,

            'role' => Role::class,
            'permission' => Permission::class,

            'subscribed' => Subscribed::class

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
