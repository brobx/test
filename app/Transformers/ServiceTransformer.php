<?php

namespace App\Transformers;

use App\Helpers\Renderers\FilterFieldRenderer;
use App\Filters\Services\QueryFilter;
use Logaretm\Transformers\Transformer;

class ServiceTransformer extends Transformer
{

    /**
     * @param $item
     * @return mixed
     */
    public function getTransformation($item)
    {
        $queryObject = QueryFilter::makeQueryObject($item->id);

        return [
            'id' => $item->id,
            'name' => $item->translate()->name,
            'icon' => $item->icon,
            'quickFields' => $queryObject ? $this->getFields($queryObject->getQuickSearchFields()) : null
        ];
    }

    /**
     * @param $fields
     * @return array
     */
    protected function getFields($fields)
    {
        $renderedFields = [];

        foreach ($fields as $field) {
            $renderedFields[] = FilterFieldRenderer::render($field);
        }

        return $renderedFields;
    }
}