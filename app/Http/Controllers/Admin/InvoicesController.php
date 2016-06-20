<?php

namespace App\Http\Controllers\Admin;

use App\Corporate;
use App\Filters\Admin\InvoiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * @param Request $request
     * @param InvoiceFilter $filters
     * @return mixed
     * @internal param InvoiceFilter $filters
     */
    public function index(Request $request, InvoiceFilter $filters)
    {
        $invoices = Invoice::with('billable')
                           ->latest()
                           ->filter($filters)
                           ->paginate(20)
                           ->appends($request->except('page'));
        
        $corporates = Corporate::lists('name', 'id')->toArray();

        return view('admin.invoices.index', compact('invoices', 'corporates'));
    }

    /**
     * @param Invoice $invoice
     * @return mixed
     */
    public function update(Invoice $invoice)
    {
        $invoice->paid = true;
        $invoice->save();

        return redirect()->route('backend.admin.invoices.index')
                         ->with('success', 'Invoice was set as paid successfully.');
    }
}
