<?php


namespace App\Filters\Services\Banking;


use App\Filters\Services\QueryFilter;
use App\ListingField;

class Deposits extends QueryFilter
{
    /**
     * @var int
     */
    protected $serviceId = 6;

    /**
     * @var array
     */
    protected $requestMap = [
        'sharia_compliant' => 'sharia',
        'currency' => 'currency',
        'tenure' => 'tenure',
        'amount' => 'amount',
        'deposit_type' => 'type'
    ];

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', ['Currency', 'Sharia Compliant', 'Tenure'])
                                ->get();

        return $fields->add(new ListingField([
            'name' => 'amount',
            'type' => 'textbox',
            'settings' => ['validation' => 'numeric', 'label' => trans('main.loanAmount')]
        ]));
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        $fields = $this->getQuickSearchFields()->add(
            $this->service->listingFields()
                          ->with('options')
                          ->whereIn('name', ['Deposit Type'])
                          ->first()
        );

        return $fields;
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
    protected function queryTenure($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Tenure')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * @param $value
     */
    protected function queryType($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Deposit Type')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * @param $value
     */
    protected function queryAmount($value)
    {
        $this->numberBetween($value, "Amount");
    }

    /**
     * Sortable Fields.
     *
     * @return array
     */
    public function getSortableFields()
    {
        $fields = $this->service->listingFields()->with('translations')->get();

        return [
            'interest' => $this->extractFieldNameFromList($fields, 'Interest Rate'),
            'penalty' => $this->extractFieldNameFromList($fields, 'Early Withdrawal Penalty'),
            'payment_frequency' => $this->extractFieldNameFromList($fields, 'Interest Payment Frequency'),
            'rating' => trans('main.serviceRating')
        ];
    }

    /**
     * @param string $order
     */
    protected function orderByInterest($order = 'DESC')
    {
        $this->orderByNumericField('Interest Rate', $order);
    }

    /**
     * @param string $order
     */
    protected function orderByPenalty($order = 'DESC')
    {
        $this->orderByNumericField('Early Withdrawal Penalty', $order);
    }

    /**
     * @param string $order
     */
    protected function orderByPaymentFrequency($order = 'DESC')
    {
        $this->orderByNumericField('Interest Payment Frequency', $order);
    }

    /**
     * @return mixed
     */
    public function getComparisonFields()
    {
        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', [
                                 'Deposit Type',
                                 'Interest Rate',
                                 'Interest Payment Frequency',
                                 'Amount Min.',
                                 'Early Withdrawal Penalty',
                                 'Banking Channels'
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
