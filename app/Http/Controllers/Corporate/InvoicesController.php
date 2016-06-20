<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Requests;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;

class InvoicesController extends CorporateController
{
    /**
     * @return mixed
     */
    public function index()
    {
        $invoices = $this->corporate->invoices()->paginate(20);

        return view('corporate.invoices.index', compact('invoices'));
    }

    /**
     * @param Invoice $invoice
     * @return mixed
     */
    public function show(Invoice $invoice)
    {
        try {
            $this->authorize($invoice);
        }

        catch (AuthorizationException $ex) {
            return redirect()->route('backend.corporate.invoices.index')
                             ->withErrors('This invoice does not belong to your corporate.');
        }

        $items = $this->getInvoiceItems($invoice);

        return view('corporate.invoices.show', compact('invoice', 'items'));
    }

    /**
     * @param Invoice $invoice
     */
    public function getPrint(Invoice $invoice)
    {
        try {
            $this->authorize('show', $invoice);
        }

        catch (AuthorizationException $ex) {
            return redirect()->route('backend.corporate.invoices.index')
                             ->withErrors('This invoice does not belong to your corporate.');
        }

        $items = $this->getInvoiceItems($invoice);

        return view('corporate.invoices.print', compact('invoice', 'items'));
    }

    /**
     * @param Invoice $invoice
     * @return mixed
     */
    private function getInvoiceItems(Invoice $invoice)
    {
        $items = [];
        if($this->corporate->type_id != 3) {
            $items = $this->corporate->leads()
                                     ->with('listing')
                                     ->whereBetween('leads.created_at', [
                                        Carbon::instance($invoice->created_at)->startOfMonth(),
                                        Carbon::instance($invoice->created_at)->endOfMonth()
                                     ])
                                     ->selectRaw('count(*) as count, leads.id, listings.name, listings.id as listing_id')
                                     ->groupBy('listing_id')
                                     ->get();
        }
        else {
            $items = $this->corporate->transactions()
                                     ->with('listing')
                                     ->completed()
                                     ->whereBetween('transactions.created_at', [
                                         Carbon::instance($invoice->created_at)->startOfMonth(),
                                         Carbon::instance($invoice->created_at)->endOfMonth()
                                     ])->get();
        }

        return $items;
    }
}
