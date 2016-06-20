<?php


namespace App\Transformers;


use Logaretm\Transformers\Transformer;

class ServiceTypeTransformer extends Transformer
{
    /**
     * @param $item
     * @return mixed
     */
    public function getTransformation($item)
    {
        return [
            'id' => $item->id,
            'title' => $item->translate()->title
        ];
    }
}