<?php


namespace App\Transformers;


use Logaretm\Transformers\Transformer;

class ListingTransformer extends Transformer
{

    /**
     * @param $item
     * @return mixed
     */
    public function getTransformation($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->translate()->name,
            'image' => imagePath($item->corporate->details->logo),
        ];
    }
}