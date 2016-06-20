<?php

namespace App\Calculators;

use Illuminate\Http\Request;

abstract class Calculator
{
    /**
     * @var
     */
    protected $entity;

    /**
     * @var Request
     */
    protected $request;
    
    /**
     * Calculator constructor.
     * @param $entity
     * @param Request $request
     */
    public function __construct($entity = null, Request $request = null)
    {
        $this->entity = $entity;
        $this->request = $request ?: request();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if(method_exists($this, $name)) {
            return $this->{$name}();
        }
    }
}