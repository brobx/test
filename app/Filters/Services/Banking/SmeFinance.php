<?php

namespace App\Filters\Services\Banking;

use App\Filters\Services\QueryFilter;
use App\ListingField;

class SmeFinance extends QueryFilter
{
    /**
     * @var int
     */
    protected $serviceId = 7;

    /**
     * @var array
     */
    protected $requestMap = [
        'amount' => 'amount',
        'tenure' => 'tenure',
        'min_annual_turnover' => 'turnover',
        'yearsinbusiness' => 'years',
        'not_secured' => 'secured',
        'sharia_compliant' => 'sharia',
    ];

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', ['Min. Annual Turnover', 'Years in business'])
                                ->get();

        $fields->add(new ListingField([
            'name' => 'amount',
            'type' => 'textbox',
            'settings' => ['validation' => 'numeric', 'label' => trans('main.loanAmount')]
        ]));

        $fields->add(new ListingField([
            'name' => 'tenure',
            'type' => 'rangeslider',
            'unit' => trans('main.years'),
            'settings' => [
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'label' => trans('main.tenure')
            ]
        ]));

        return $fields;
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        $fields = $this->getQuickSearchFields()->merge(
            $this->service->listingFields()
            ->with('options')
            ->whereIn('name', ['Not Secured', 'Sharia Compliant'])
            ->get()
        );


        return $fields;
    }

    /**
     * @param $value
     */
    protected function queryTenure($value)
    {
        $this->numberBetween($value, "Tenure");
    }

    /**
     * @param $value
     */
    protected function queryAmount($value)
    {
        $this->numberBetween($value, "Amount");
    }

    /**
     * @param $value
     */
    protected function queryTurnover($value)
    {
        $this->numberBiggerThan($vlaue, "Min. Annual Turnover");
    }

    /**
     * @param $value
     */
    protected function queryYears($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Years in business')->where('listing_listing_field.value', $value);
        });
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
    protected function querySecured($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Not Secured')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Sortable Fields.
     *
     * @return array
     */
    public function getSortableFields()
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function getComparisonFields()
    {
        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', [
                                 'Interest Rate',
                                 'Average Processing Time',
                                 'Banking Channels'
                             ])->get();
    }

    /**
     * Gets the rating parameters names.
     *
     * @return array
     */
    public function getRatingParameters()
    {
        return [
            'Application Processing Experience',
            'Decision Timing',
            'Accuracy of advertised information',
            'Customer Service',
        ];
    }
}
