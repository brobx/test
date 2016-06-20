<?php


namespace App\Filters\Services\Banking;


use App\Filters\Services\QueryFilter;
use App\ListingField;

class SmeAccounts extends QueryFilter
{
    /**
     * @var int
     */
    protected $serviceId = 8;

    /**
     * @var array
     */
    protected $requestMap = [
        'account_type' => 'type',
        'currency' => 'currency',
        'sharia_compliant' => 'sharia',
        'min_balance' => 'balance'
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
        return $this->getQuickSearchFields()->add(new ListingField([
            'name' => 'Min Balance',
            'settings' => ['validation' => 'numeric', 'label' => trans('main.minBalance')],
            'type' => 'textbox'
        ]));
    }

    /**
     * Queries the sharia.
     *
     * @param $value
     */
    protected function querySharia($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Sharia Compliant')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries the currency.
     *
     * @param $value
     */
    protected function queryCurrency($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Currency')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries the account type.
     *
     * @param $value
     */
    protected function queryType($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Account Type')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries the minimum balance.
     *
     * @param $value
     */
    protected function queryBalance($value)
    {
        $this->numberBiggerThan($vlaue, "Min. Balance");
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
                                 'Account Type',
                                 'Min. Balance',
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
            'Branch Service',
            'Telephone Service',
            'Online Banking Service',
            'ATM',
            'Accuracy of advertised information'
        ];
    }
}
