<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Contracts\View\View;

class ActivityController extends Controller
{
    public function view(): View
    {

        $activities = Activity::latest()->whereHas('user')->get();

        return view('pages.activity.list', compact('activities'));
    }
}
