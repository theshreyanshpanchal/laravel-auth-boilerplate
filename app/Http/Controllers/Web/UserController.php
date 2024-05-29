<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function view(): View
    {
        $users = User::query()

            ->select('id', 'first_name', 'last_name', 'email')

            ->with('roles:id,name')

            ->excludeAdmin()

            ->get();

        return view('pages.user.list', compact('users'));
    }
}
