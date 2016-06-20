<?php

namespace App\Filters\Services\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface QueryFilter
{
    /**
     * @return mixed
     */
    public function getQuickSearchFields();

    /**
     * @return mixed
     */
    public function getAdvancedSearchFields();

    /**
     * @return mixed
     */
    public function getSortableFields();
    
    /**
     * @return mixed
     */
    public function getComparisonFields();

    /**
     * @return mixed
     */
    public function getRatingParameters();

    /**
     * @return mixed
     */
    public function filter();

    /**
     * @param Builder $builder
     * @return mixed
     */
    public function apply(Builder $builder);
}