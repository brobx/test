<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Transaction;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->paginate(50);

        return view('admin.transactions.index', compact('transactions'));
    }
}
