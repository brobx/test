<?php

namespace App\Filters\Admin;

use App\Filters\Filter;
use Carbon\Carbon;

class LeadFilter extends Filter
{
    /**
     * @param $value
     */
    public function filterByLanguage($value)
    {
        $lang = 'English';
        switch ($value) {
            case 'ar': $lang = 'Arabic';
        }

        $this->builder->where('language', $lang);
    }

    /**
     * @param $value
     */
    public function filterByType($value)
    {
        $this->builder->where('type', $value);
    }

    /**
     * @param $value
     */
    public function filterByListing($value)
    {
        $this->builder->where('listing_id', $value);
    }

    /**
     * @param $value
     */
    public function filterByFrom($value)
    {
        $date = Carbon::createFromFormat('d-m-Y', $value)->startOfDay();

        $this->builder->where('created_at', '>=', $date);
    }

    /**
     * @param $value
     */
    public function filterByTo($value)
    {
        $date = Carbon::createFromFormat('d-m-Y', $value)->endOfDay();

        $this->builder->where('created_at', '<=', $date);
    }
}