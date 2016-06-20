<?php


namespace App\Analytics\Corporate;


use App\Corporate;
use App\Lead;
use Illuminate\Support\Facades\DB;

class Stats
{
    /**
     * @var Corporate
     */
    protected $corporate;

    /**
     * @var \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    protected $builder;

    /**
     * @var
     */
    protected $listings;

    /**
     * Stats constructor.
     * @param Corporate $corporate
     */
    public function __construct(Corporate $corporate)
    {
        $this->corporate = $corporate;
        $this->listings = $corporate->listings()->lists('id')->toArray();
        $this->builder = Lead::whereIn('listing_id', $this->listings);
    }

    /**
     *
     */
    protected function resetScope()
    {
        $this->builder = Lead::whereIn('listing_id', $this->listings);
    }

    /**
     * Gets the count of each type of the corporate leads.
     *
     * @return mixed
     */
    public function countLeads()
    {
        return $this->builder->groupBy('type')
                             ->select('type', DB::raw('count(*) as total'))
                             ->pluck('total', 'type')
                             ->toArray();
    }

    /**
     *
     */
    public function yearlyLeads()
    {
        return $this->builder->spanYears(4)
                             ->selectRaw('DATE_FORMAT(created_at, "%Y") as year, count(*) as count')
                             ->groupBy('year')
                             ->pluck('count', 'year')
                             ->toArray();
    }

    /**
     * @return mixed
     */
    public function monthlyLeads()
    {
        $thisYear = $this->builder->thisYear()
                                  ->selectRaw('DATE_FORMAT(created_at, "%M") as month, count(*) as count')
                                  ->groupBy('month')
                                  ->pluck('count', 'month')
                                  ->toArray();

        $this->resetScope();

        $lastYear = $this->builder->lastYear()
                                  ->selectRaw('DATE_FORMAT(created_at, "%M") as month, count(*) as count')
                                  ->groupBy('month')
                                  ->pluck('count', 'month')
                                  ->toArray();

        return [
            'Last Year' => $lastYear,
            'This Year' => $thisYear
        ];
    }

    /**
     * @return mixed
     */
    public function weeklyLeads()
    {
        $thisWeek = $this->builder->thisWeek()
                             ->selectRaw('DATE_FORMAT(created_at, "%W") as day, count(*) as count')
                             ->groupBy('day')
                             ->pluck('count', 'day')
                             ->toArray();

        $this->resetScope();

        $lastWeek = $this->builder->lastWeek()
                                  ->selectRaw('DATE_FORMAT(created_at, "%W") as month, count(*) as count')
                                  ->groupBy('month')
                                  ->pluck('count', 'month')
                                  ->toArray();

        return [
            'Last Week' => $lastWeek,
            'This Week' => $thisWeek
        ];
    }

    /**
     * @param $period
     * @return mixed
     */
    public function getPeriodLabels($period)
    {
        switch ($period) {
            case 'monthly':
                return $this->getMonthsNames();
            case 'yearly':
                return $this->getYearsNames();
        }

        return $this->getDaysNames();
    }

    /**
     * @return mixed
     */
    public function getDaysNames()
    {
        $timestamp = strtotime('next Sunday');
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[strftime('%A', $timestamp)] = 0;
            $timestamp = strtotime('+1 day', $timestamp);
        }

        return $days;
    }

    /**
     * @return array
     */
    public function getMonthsNames()
    {
        $timestamp = strtotime('first of year');
        $months = [];

        for ($i = 0; $i < 12; $i++) {
            $months[strftime('%B', $timestamp)] = 0;
            $timestamp = strtotime('+1 month', $timestamp);
        }

        return $months;
    }

    /**
     * @return array
     */
    public function getYearsNames()
    {
        $years = [];
        $timestamp = strtotime('now');
        for ($i = 0; $i < 4; $i++) {
            $years[strftime('%Y', $timestamp)] = 0;
            $timestamp = strtotime('-1 year', $timestamp);
        }

        return $years;
    }

    /**
     * @return
     */
    public function rating()
    {
        return (int)$this->corporate->reviews()->avg('rating');
    }
}
