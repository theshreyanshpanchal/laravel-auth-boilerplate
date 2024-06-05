<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;

class TransactionController extends Controller
{
    public function view(): View
    {
        $transactions = Transaction::latest()->get();

        return view('pages.transaction.list', compact('transactions'));
    }
}
