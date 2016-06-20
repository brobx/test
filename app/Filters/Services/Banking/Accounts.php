<?php

namespace App\Filters\Services\Banking;

use App\Filters\Services\QueryFilter;

class Accounts extends QueryFilter
{
    /**
     * @var int
     */
    protected $serviceId = 5;

    /**
     * @var array
     */
    protected $requestMap = [
        'sharia_compliant' => 'sharia',
        'currency' => 'currency',
        'account_type' => 'type'
    ];
    
    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        return $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', ['Currency', 'Account Type', 'Sharia Compliant'])
                                ->get();
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        return $this->getQuickSearchFields();
    }

    /**
     * @param $value
     */
    protected function querySharia($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Sharia Compliant')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * @param $value
     */
    protected function queryCurrency($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Currency')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * @param $value
     */
    protected function queryType($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Account Type')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * @return array
     */
    public function getSortableFields()
    {
        $fields = $this->service->listingFields()->with('translations')->get();

        return [
            'monthly_fees' => $this->extractFieldNameFromList($fields, 'Monthly Fees'),
            'rating' => trans('main.serviceRating')
        ];
    }

    /**
     *
     */
    public function getComparisonFields()
    {
        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', [
                                 'Interest Rate', 'Account Type', 'Monthly Fees',
                                 'Min. Balance', 'Banking Channels', 'Service Rating'
                             ])->get();
    }

    /**
     * Orders by the monthly fees.
     *
     * @param string $order
     */
    protected function orderByMonthlyFees($order = 'DESC')
    {
        $this->orderByNumericField('Monthly Fees', $order);
    }

    /**
     * Gets the rating parameters.
     * 
     * @return array
     */
    public function getRatingParameters()
    {
       return [
           'Branch Service',
           'Telephone Service',
           'Online Banking Service',
           'ATM',
           'Accuracy of advertised information'
       ];
    }
}