<?php


namespace App\Filters\Admin;


use App\Corporate;
use App\Filters\Filter;

class InvoiceFilter extends Filter
{
    /**
     * Filters by the corporate id.
     * 
     * @param $value
     */
    public function filterByCorporate($value)
    {
        $this->builder->where('billable_type', Corporate::class)
                      ->where('billable_id', $value);
    }

    /**
     * Filters by the payment status (paid or unpaid)
     * 
     * @param $value
     */
    public function filterByPaid($value)
    {
        $this->builder->where('paid', $value === 'paid');
    }
}