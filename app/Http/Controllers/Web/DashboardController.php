<?php

namespace App\Http\Controllers\Web;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    public function view(): View
    {
        $isAdmin = Auth::user()->roles->first()->name === UserRole::ADMIN->value;

        $admins = User::onlyAdmin()->count();

        $users = User::excludeAdmin()->count();

        $roles = Role::count();

        $permissions = Permission::count();

        return view('pages.dashboard' , compact('isAdmin', 'admins', 'users', 'roles', 'permissions'));
    }
}
