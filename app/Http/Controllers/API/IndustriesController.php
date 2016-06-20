<?php

namespace App\Http\Controllers\API;

use App\CorporateType;
use App\Transformers\ServiceTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndustriesController extends APIController
{
    /**
     * @param CorporateType $type
     * @param ServiceTransformer $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function services(CorporateType $type, ServiceTransformer $transformer)
    {
        $services = $type->services;

        return $this->respond([
            'services' => [
                'data' => $transformer->transform($services)
            ]
        ]);
    }
}
