<?php

namespace App\Filters\Services\Broadband;

use App\Filters\Services\QueryFilter;
use App\ListingFieldOption;

class VoicePlan extends QueryFilter
{

    /**
     * @var array
     */
    protected $requestMap = [
        'postpaid_prepaid' => 'payment',
        'monthly_fees' => 'fees',
        'minutes(anyoperator)' => 'minutes',
        'monthly_data_quota' => 'dataQuota',
        's_m_s(anyoperator)' => 'sms',
        'data_device_sharing' => 'sharing',
        'minute_rate' => 'minuteRate'
    ];

    /**
     * @var int
     */
    protected $serviceId = 10;

    /**
     * @return mixed
     */
    public function getQuickSearchFields()
    {
        $fields = $this->service->listingFields()
                                ->with('options')
                                ->whereIn('name', ['Postpaid / Prepaid', 'Monthly Fees', 'Minutes (any operator)', 'Monthly Data Quota'])
                                ->get();

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
                          ->whereIn('name', ['SMS (any operator)', 'Minute Rate', 'Data Device Sharing'])
                          ->get()
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
     * Queries the minute rate.
     *
     * @param $value
     * @return
     */
    public function queryMinuteRate($value)
    {
        $this->numberBiggerThan($value, 'Minute Rate');
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
     * Queries Minutes.
     *
     * @param $value
     */
    public function queryMinutes($value)
    {
        $this->numberBiggerThan($value, "Minutes (any operator)");
    }

    /**
     * Queries Minutes.
     *
     * @param $value
     */
    public function querySms($value)
    {
        $this->numberBiggerThan($value, "SMS (any operator)");
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
     * @return mixed
     */
    public function getComparisonFields()
    {
        $names = [
            'Postpaid / Prepaid',
            'Minutes (same operator)',
            'Minutes (any operator)',
            'SMS (same operator)',
            'SMS (any operator)',
            'Monthly Data Quota',
            'Additional MBs',
            'Data Device Sharing',
        ];

        if($this->request->has('postpaid_prepaid')) {
            $names[] = ListingFieldOption::findOrFail($this->request->get("postpaid_prepaid"))->name === "Postpaid" ? "Monthly Fees" : "Minute Rate";
        }

        return $this->service->listingFields()
                             ->with('options')
                             ->whereIn('name', $names)
                             ->get();
    }
}
