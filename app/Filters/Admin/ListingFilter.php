<?php

namespace App\Filters\Admin;

use App\Filters\Filter;

class ListingFilter extends Filter
{
    /**
     * @param $value
     */
    public function filterByService($value)
    {
        $this->builder->where('service_id', $value);
    }

    /**
     * @param $value
     */
    public function filterByCorporate($value)
    {
        $this->builder->where('corporate_id', $value);
    }

    /**
     * @param $value
     */
    public function filterByStatus($value)
    {
        if ($value === 'not') {
            $this->builder->where('featured', false);

            return;
        }

        $this->builder->where('featured', true);

        if ($value === 'active') {
            $this->builder->whereRaw('impressions < targeted_impressions');

            return;
        }

        if ($value === 'inactive') {
            $this->builder->whereRaw('impressions >= targeted_impressions');

            return;
        }
    }
}