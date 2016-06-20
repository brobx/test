<?php


namespace App\Filters\Services\Banking;


use App\Filters\Services\QueryFilter;
use App\ListingField;
use App\ListingFieldValue;
use Illuminate\Http\Request;
use App\Calculators\LoanCalculator;

class PersonalLoan extends QueryFilter
{
    /**
     * @var array
     */
    protected $requestMap = [
        'amount' => 'amount',
        'tenure' => 'tenure',
        'income' => 'income',
        'age' => 'age',
        'sharia_compliant' => 'sharia',
        'employment_status' => 'employment',
        'salary_transfer' => 'transfer',
        'business_type' => 'businessType',
        'employer_type' => 'employerType'
    ];

    /**
     * @var int
     */
    protected $serviceId = 2;

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        return [
            new ListingField([
                'name' => 'amount',
                'type' => 'textbox',
                'settings' => ['validation' => 'numeric', 'label' => trans('main.loanAmount')]
            ]),
            new ListingField([
                'name' => 'tenure',
                'type' => 'rangeslider',
                'unit' => trans('main.years'),
                'settings' => [
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'label' => trans('main.tenure')
                ]
            ]),
            new ListingField([
                'name' => 'income',
                'type' => 'textbox',
                'settings' => ['validation' => 'numeric', 'label' => trans('main.income')]
            ]),
        ];
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', [
                                    'Employment Status',
                                    'Salary Transfer',
                                    'Sharia Compliant',
                                    'Business Type',
                                    'Employer Type'
                                ])->get();

        foreach ($this->getQuickSearchFields() as $field) {
            $fields->add($field);
        }

        $fields->add(new ListingField([
            'name' => 'age',
            'type' => 'textbox',
            'settings' => ['validation' => 'numeric', 'label' => trans('main.age')]
        ]));

        return $fields;
    }

    /**
     * @param $value
     */
    protected function queryIncome($value)
    {
        $this->numberBetween($value, "Income");
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
        $income = (int)$this->request->get('income');

        if(! $income) {
            return;
        }

        $query = clone $this->query;
        $calculator = new LoanCalculator();
        $listings = $query->get()->filter(function ($listing) use ($income, $value, $calculator) {
            $amount = $calculator->maxLoanAmount($listing, $income);

            return $amount >= $value;
        });

        $this->query->whereIn('id', $listings->pluck('id'));
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
    protected function queryTransfer($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Salary Transfer')->where('listing_listing_field.value', $value);
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
     * @return mixed
     */
    public function getComparisonFields()
    {
        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', [
                                 'Interest Rate',
                                 'Average Processing Time',
                             ])->get();
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
