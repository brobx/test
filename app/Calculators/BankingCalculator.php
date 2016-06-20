<?php


namespace App\Calculators;


use App\Service;

class BankingCalculator extends Calculator
{

    /**
     * Calculates the monthly installment for a listing.
     *
     * @return float
     */
    public function monthlyInstallment()
    {
        if (! $this->request->has('amount')) {
            return '---';
        }

        $amount = $this->request->get('amount', 0);
        $tenure = $this->request->get('tenure', 1);

        $interest = $this->entity->getFieldValue('Interest Rate');
        if(! $interest) {
            $interest = $this->entity->getFieldValue('Interest rate');
        }

        $interest /= 100;

        // Amount * (Interest Rate/12)
        $numerator = $amount * $interest / 12;

        //1 - (1+ (interest Rate/12))^(-tenure*12)
        $denominator = 1 - (1 + ($interest / 12)) ** -($tenure * 12);

        return number_format(round($numerator / $denominator, 0, PHP_ROUND_HALF_UP));
    }

    /**
     * @return string
     */
    public function totalCostOfCredit()
    {
        if (! $this->request->has('amount')) {
            return '---';
        }

        $interest = $this->entity->getFieldValue('Interest Rate');
        if(! $interest) {
            $interest = $this->entity->getFieldValue('Interest rate');
        }

        $amount = $this->request->get('amount', 0);
        $tenure = $this->request->get('tenure', 1);
        $interest /= 100;

        $totalCost = ($amount * $interest * $tenure) +
            $this->entity->getFieldValue('Application Fees') +
            $this->entity->getFieldValue('Onetime Fees') +
            ($this->entity->getFieldValue('Monthly Fees') * $tenure * 12) +
            ($this->entity->getFieldValue('Annual Fees') * $tenure);

        return number_format($totalCost);
    }

    /**
     * @return array
     */
    public function recommendations()
    {
        $value = $this->request->get(trans('main.income'));
        foreach ($this->request->get('expenses') as $expense) {
            $value -= $expense;
        }

        if($value <= 0) {
            return [
                'savings' => [],
                'borrowing' => [],
            ];
        }

        if($value <= 500) {
            return [
                'savings' => Service::where('name', 'Account')->get(),
                'borrowing' => []
            ];
        }

        if($value <= 1000) {
            return [
                'savings' => Service::where('name', 'Account')->get(),
                'borrowing' => Service::where('name', 'Credit Card')->get()
            ];
        }

        if($value <= 5000) {
            return [
                'savings' => Service::where('name', 'Deposit')->get(),
                'borrowing' => Service::whereIn('name', ['Credit Card', 'Car Loans'])->get()
            ];
        }

        return [
            'savings' => Service::where('name', 'Deposit')->get(),
            'borrowing' => Service::whereIn('name', ['Credit Card', 'Car Loans', 'Home Loans'])->get()
        ];
    }
}