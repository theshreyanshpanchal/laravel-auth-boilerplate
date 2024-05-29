<?php

use App\Http\Controllers\Web\ActivityController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\RolePermissionController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('pages.landing'); });

Route::middleware('guest')->group(function() {

    Route::prefix('login')->group(function() {

        Route::get('/', [AuthController::class, 'loginView'])->name('view:login');

        Route::post('/', [AuthController::class, 'login'])->name('login');

    });

    Route::prefix('register')->group(function() {

        Route::get('/', [AuthController::class, 'registerView'])->name('view:register');

        Route::post('/', [AuthController::class, 'register'])->name('register');

    });

    Route::prefix('reset-password')->group(function() {

        Route::get('/', [AuthController::class, 'resetPasswordView'])->name('view:reset-password');

        Route::post('/', [AuthController::class, 'resetPassword'])->name('reset-password');

        Route::post('/send-otp', [AuthController::class, 'sendResetPasswordOtp'])->name('send:reset-password-otp');

        Route::post('/verify', [AuthController::class, 'verifyResetPasswordOtp'])->name('verify:reset-password-otp');

    });

    Route::prefix('social')->group(function() {

        Route::get('/{provider}/redirect', [AuthController::class, 'socialiteRedirect'])->name('socialite:redirect');

        Route::get('/{provider}/callback', [AuthController::class, 'socialiteCallback'])->name('socialite:callback');

    });

});


Route::middleware('authenticate')->group(function() {

    Route::middleware('not-verified')->group(function() {

        Route::prefix('verify')->group(function() {

            Route::get('/', [AuthController::class, 'verifyView'])->name('view:verify');

            Route::post('/', [AuthController::class, 'verify'])->name('verify');

            Route::get('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend:otp');

        });

        Route::get('/reverify', [AuthController::class, 'reverify'])->name('reverify');

    });

    Route::middleware('verified')->group(function() {

        Route::middleware('role:admin')->group(function() {

            Route::prefix('users')->group(function() {

                Route::get('/', [UserController::class, 'view'])->name('view:users');

            });

            Route::prefix('role-permissions')->group(function() {

                Route::get('/', [RolePermissionController::class, 'viewRoles'])->name('view:roles');

                Route::get('/{role}/permissions', [RolePermissionController::class, 'viewPermissions'])->name('view:permissions');

                Route::post('/{role}/permissions', [RolePermissionController::class, 'syncRolePermissions'])->name('sync:role-permissions');

            });

            Route::prefix('activities')->group(function() {

                Route::get('/', [ActivityController::class, 'view'])->name('view:activities');

            });

        });

        Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard')->middleware(['permission:dashboard']);;

        Route::prefix('profile')->group(function() {

            Route::get('/', [AuthController::class, 'profileView'])->name('view:profile');

            Route::post('/', [AuthController::class, 'profile'])->name('profile');

        });

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });

});

