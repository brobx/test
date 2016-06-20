<?php

namespace App\Filters\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    /**
     * @param Builder|null $builder
     * @return mixed
     */
    public function apply(Builder $builder = null);
}