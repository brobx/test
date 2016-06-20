<?php


namespace App\Filters\Services\Broadband;


use App\Filters\Services\QueryFilter;
use App\ListingField;
use App\ListingFieldOption;

class Adsl extends QueryFilter
{

    /**
     * @var array
     */
    protected $requestMap = [
        'speed' => 'speed',
        'subscription_period' => 'period',
        'monthly_fees' => 'fees',
        'monthly_data_quota' => 'dataQuota',
        'free_router' => 'router'
    ];

    /**
     * @var int
     */
    protected $serviceId = 12;

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', ['Speed', 'Subscription Period', 'Monthly Data Quota'])
                                ->get();


        return $fields->add(new ListingField([
            'name' => 'Fees',
            'type' => 'textbox',
            'settings' => ['label' => trans('main.fees')]
        ]));
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        return $this->getQuickSearchFields()->add(
            $this->service->listingFields()
                          ->with('options')
                          ->where('name', 'Free Router')
                          ->first()
        );
    }

    /**
     * Queries Fees.
     *
     * @param $value
     */
    public function queryFees($value)
    {
        $option = ListingFieldOption::find($this->request->get('payment_period'));

        if (!$option) {
            return;
        }

        $feesName = $option->name . ' Fees';

        $this->numberBiggerThan($value, $feesName);
    }

    /**
     * Queries Data Quota.
     *
     * @param $value
     */
    public function queryDataQuota($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', ' Monthly Data Quota')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries Speed.
     *
     * @param $value
     */
    public function querySpeed($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Speed')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries Payment Period.
     *
     * @param $value
     */
    public function queryPeriod($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Payment Period')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries Payment Period.
     *
     * @param $value
     */
    public function queryRouter($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Free Router')->where('listing_listing_field.value', $value);
        });
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
            'data_quota' => $this->extractFieldNameFromList($fields, 'Monthly Data Quota'),
        ];
    }

    /**
     * @param $order
     */
    public function orderByDataQuota($order)
    {
        $this->orderByNumericField('Monthly Data Quota', $order);
    }

    /**
     * @return mixed
     */
    public function getComparisonFields()
    {
        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', [
                                 'Speed',
                                 'Subscription Period',
                                 'Free Router',
                                 'Monthly Data Quota',
                                 'Additional MBs'
                             ])->get();
    }
}
