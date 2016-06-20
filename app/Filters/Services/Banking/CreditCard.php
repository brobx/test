<?php


namespace App\Filters\Services\Banking;

use App\Filters\Services\QueryFilter;
use App\ListingField;
use App\ListingFieldValue;
use Illuminate\Support\Facades\DB;

class CreditCard extends QueryFilter
{

    /**
     * @var array
     */
    protected $requestMap = [
        'income' => 'income',
        'sharia_compliant' => 'sharia',
        'rewards' => 'rewards',
        'age' => 'age',
        'employment_status' => 'employment',
        'business_type' => 'businessType',
        'employer_type' => 'employerType'
    ];

    /**
     * @var int
     */
    protected $serviceId = 1;

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', ['Rewards', 'Sharia Compliant'])
                                ->get();

        return $fields->add(new ListingField([
            'name' => 'income',
            'type' => 'textbox',
            'settings' => ['validation' => 'numeric', 'label' => trans('main.income')]
        ]));
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', [
                                    'Rewards',
                                    'Sharia Compliant',
                                    'Employment Status',
                                    'Business Type',
                                    'Employer Type'
                                ])->get();

        return $fields->add(new ListingField([
            'name' => 'income',
            'type' => 'textbox',
            'settings' => ['validation' => 'numeric', 'label' => trans('main.income')]

        ]))->add(new ListingField([
            'name' => 'age',
            'type' => 'textbox',
            'settings' => ['validation' => 'numeric', 'label' => trans('main.age')]
        ]));
    }

    /**
     * Queries The income.
     *
     * @param $value
     */
    protected function queryIncome($value)
    {
        $this->numberBetween($value, "Income");
    }

    /**
     * Queries The age.
     *
     * @param $value
     */
    protected function queryAge($value)
    {
        $this->numberBetween($value, "Age");
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
    protected function queryEmployment($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Employment Status')->where('listing_listing_field.value', $value);
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
    protected function queryEmployerType($value)
    {
        $this->queryExact('Employer Type', $value);
    }

    /**
     * @param $value
     */
    protected function queryBusinessType($value)
    {
        $this->queryExact('Business Type', $value);
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
            'processing_time' => $this->extractFieldNameFromList($fields, 'Average Processing Time'),
            'interest' => $this->extractFieldNameFromList($fields, 'Interest Rate'),
            'rating' => trans('main.serviceRating')
        ];
    }

    /**
     * Orders by the average processing time.
     *
     * @param string $order
     */
    protected function orderByProcessingTime($order = 'DESC')
    {
        $this->orderByNumericField('Average Processing Time', $order);
    }

    /**
     * @param string $order
     */
    protected function orderByInterest($order = 'DESC')
    {
        $this->orderByNumericField('Interest Rate', $order);
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
                                 'Annual Fees',
                                 'Rewards',
                                 'Average Processing Time',
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
