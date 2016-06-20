<?php

namespace App\Filters;

use App\Filters\Contracts\Filter as FilterContract;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter implements FilterContract
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * Filter constructor.
     * @param Builder $builder
     * @param Request $request
     */
    public function __construct(Builder $builder, Request $request = null)
    {
        $this->request = $request ?: request();
        $this->builder = $builder;
    }

    /**
     * Applies the request input as filters.
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder = null)
    {
        $this->builder = ! $builder ?: $builder;

        foreach ($this->request->input() as $key => $value) {
            $this->findFilter($key, $value);
        }
        
        return $this->builder;
    }

    /**
     * Finds and executes a filter method.
     *
     * @param $name
     * @param $value
     */
    protected function findFilter($name, $value)
    {
        if(! $value) {
            return;
        }

        $methodName =  camel_case('filterBy_' . $name);

        if(method_exists($this, $methodName)) {
            $this->{$methodName}($value);
        }
    }
}