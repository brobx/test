<?php

namespace App\Billing;

use App\Invoice;

trait Billable
{
    /**
     * @param $amount
     * @param $message
     * @param array|null $options
     * @return null
     */
    public function bill($amount, $message, $options = [])
    {
        // Don't create invoices for less than 0.
        if ($amount <= 0) {
            return null;
        }

        $paid = ! $amount;
        $discount = array_has($options, 'discount') ? $options['discount'] : 0;

        $invoice = $this->invoices()->create(compact('amount', 'message', 'paid', 'discount'));

        if (array_has($options, 'services')) {
            $invoice->services()->attach($options['services']);
        }

        return $invoice;
    }

    /**
     * @return mixed
     */
    public function invoices()
    {
        return $this->morphMany(Invoice::class, 'billable');
    }
}