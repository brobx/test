<?php

use App\Service;
use App\ServiceType;
use App\Transformers\ServiceTransformer;
use App\Transformers\ServiceTypeTransformer;

return [
    'transformers' => [
        Service::class => ServiceTransformer::class,
        ServiceType::class => ServiceTypeTransformer::class
    ]
];
