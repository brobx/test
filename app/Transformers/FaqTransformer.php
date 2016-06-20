<?php


namespace App\Transformers;


use Logaretm\Transformers\Transformer;

class FaqTransformer extends Transformer
{

    /**
     * @param $item
     * @return mixed
     */
    public function getTransformation($item)
    {
        return [
            'id' => $item->id,
            'question' => $item->translate()->question
        ];
    }
}