<?php


namespace App\Filters\Services\Broadband;


use App\Filters\Services\QueryFilter;

class DataPlan extends QueryFilter
{
    /**
     * @var array
     */
    protected $requestMap = [
        'postpaid_prepaid' => 'payment',
        'monthly_fees' => 'fees',
        'monthly_data_quota' => 'dataQuota',
        'data_device_sharing' => 'sharing'
    ];

    /**
     * @var int
     */
    protected $serviceId = 11;

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', ['Postpaid / Prepaid', 'Monthly Fees', 'Monthly Data Quota'])
                                ->get();

        return $fields;
    }

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields()
    {
        $fields = $this->getQuickSearchFields()->add(
            $this->service->listingFields()
                          ->with('options')
                          ->where('name', 'Data Device Sharing')
                          ->first()
        );

        return $fields;
    }

    /**
     * Queries the payment type.
     *
     * @param $value
     */
    public function queryPayment($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Postpaid / Prepaid')->where('listing_listing_field.value', $value);
        });
    }

    /**
     * Queries Fees.
     *
     * @param $value
     */
    public function queryFees($value)
    {
        $this->numberBiggerThan($value, "Monthly Fees");
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
     * Queries the payment type.
     *
     * @param $value
     */
    public function querySharing($value)
    {
        $this->query->whereHas('fields', function ($q) use ($value) {
            $q->where('name', 'Device Sharing')->where('listing_listing_field.value', $value);
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
            'monthly_fees' => $this->extractFieldNameFromList($fields, 'Monthly Fees'),
            'data_quota' => $this->extractFieldNameFromList($fields, 'Monthly Data Quota'),
        ];
    }

    /**
     * @param $order
     */
    public function orderByMonthlyFees($order)
    {
        $this->orderByNumericField('Monthly Fees', $order);
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
                                 'Postpaid / Prepaid',
                                 'Monthly Fees',
                                 'Monthly Data Quota',
                                 'Additional MBs',
                                 'Data Device Sharing',
                             ])->get();
    }
}
