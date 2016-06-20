<?php

namespace App\Calculators;

use Illuminate\Http\Request;

class LoanCalculator extends Calculator
{
    /**
     * @var
     */
    protected $entity;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Calculates the maximum listing loan amount for that income.
     * @param $listing
     * @param $income
     * @return mixed
     */
    public function maxLoanAmount($listing, $income)
    {
        return ($listing->getFieldValue('Max. Instalment to Net Monthly Income') / 100 * $income) * (1 - $listing->getFieldValue('Interest Rate') / 100) * ($listing->getFieldValue('Max. Amount to Net Annual Income') * 12);
    }
}
