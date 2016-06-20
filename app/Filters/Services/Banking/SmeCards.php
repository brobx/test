<?php


namespace App\Filters\Services\Banking;

use App\Filters\Services\QueryFilter;

class SmeCards extends QueryFilter
{
    /**
     * @var int
     */
    protected $serviceId = 9;

    /**
     * @var array
     */
    protected $requestMap = [
        'card_type' => 'type',
        'currency' => 'currency',
        'sharia_compliant' => 'sharia'
    ];

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', ['Rewards', 'Card Type', 'Sharia Compliant'])
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
    protected function queryRewards($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Rewards')->whereIn('listing_listing_field.value', $value);
        });
    }

    /**
     * @param $value
     */
    protected function queryType($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Card Type')->where('listing_listing_field.value', $value);
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
                                 'Card Type',
                                 'Interest Rate',
                                 'Annual Fees',
                                 'Rewards',
                                 'Banking Channels',
                             ])->get();
    }

    /**
     * Gets the rating parameters.
     *
     * @return array
     */
    public function getRatingParameters()
    {
        return [
            'Application Processing',
            'Decision Timing',
            'Accuracy of advertised information',
            'Customer Service',
            'Online Banking'
        ];
    }
}