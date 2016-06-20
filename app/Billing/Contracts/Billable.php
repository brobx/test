<?php

namespace App\Billing\Contracts;

interface Billable
{
    public function bill($amount, $message, $options = []);
}