<?php

namespace App\Billing;

use App\Billing\Contracts\Billable;
use App\Corporate;
use Carbon\Carbon;

class BillingManager
{
    /**
     * @param $billable
     */
    public function billCurrentMonth(Billable $billable)
    {
        $amount = $this->{'calculate' . ucfirst($billable->type->slug)}($billable);
        $options = $this->hasDiscount($billable) ? ['discount' => $billable->discount * $billable->lead_price] : [];

        if ($billable->type_id == 3) {
            $options['services'] = $this->getAttachedServices($billable);
        }

        $start = Carbon::now()->startOfMonth()->format('d-m-Y');
        $end = Carbon::now()->endOfMonth()->format('d-m-Y');

        $billable->bill($amount, "Invoice for the month from {$start} to {$end}.", $options);
    }

    /**
     * @param $billable
     * @return array
     */
    public function getAttachedServices($billable)
    {
        $services = $billable->servicesWithCommission;
        $attachedArray = [];

        foreach ($services as $service) {
            $attachedArray[$service->id] = ['commission' => $service->pivot->commission];
        }

        return $attachedArray;
    }

    /**
     * @param Billable $billable
     * @return bool
     */
    public function hasDiscount(Billable $billable)
    {
        return $billable->type_id == 1 && $billable->discount;
    }

    /**
     *
     */
    public static function billCorporatesForThisMonth()
    {
        $instance = new static;
        $corporates = Corporate::active()->get();

        foreach ($corporates as $corporate) {
            $instance->billCurrentMonth($corporate);
        }
    }

    /**
     * @param $corporate
     * @return mixed
     */
    public function calculateBroadband($corporate)
    {
        return $corporate->leads()->thisMonth()->count() * $corporate->lead_price;
    }

    /**
     * @param $agency
     * @return int
     */
    public function calculateTravel($agency)
    {
        $agency->load('servicesWithCommission');
        $transactions = $agency->transactions()
                               ->with('listing.fields')
                               ->thisMonth()
                               ->completed()
                               ->get();

        return $transactions->sum(function ($transaction) use($agency) {
            return $transaction->amount * $this->getTravelRate($agency, $transaction->listing);
        });
    }

    /**1
     * @param $bank
     * @return mixed
     */
    public function calculateBanking($bank)
    {
        return ($bank->leads()->thisMonth()->count() - $bank->discount) * $bank->lead_price;
    }

    /**
     * @param $agency
     * @param $lead
     * @return mixed
     */
    private function getTravelRate($agency, $listing)
    {
        return $agency->servicesWithCommission->find($listing->service_id)->pivot->commission / 100;
    }
}
