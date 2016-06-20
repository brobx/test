<?php

namespace App\Presenters\Contracts;


interface IPresentable
{
    /**
     * Provides the properties and the methods that should present an attribute.
     *
     * @return mixed
     */
    public function present();
}