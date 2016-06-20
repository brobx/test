<?php

namespace App\Http\Controllers\Corporate;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TransactionsController extends CorporateController
{
    
    public function index()
    {
        $transactions = $this->corporate->transactions()->latest()->paginate(50);

        return view('corporate.transactions.index', compact('transactions'));
    }
}
