<?php

namespace App\Http\Controllers\Admin;

use App\Corporate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $banks = Corporate::where('type_id', 1)->get();
        $agencies = Corporate::with('servicesWithCommission')->where('type_id', 3)->get();

        return view('admin.billing.index', compact('banks', 'agencies'));
    }
}
