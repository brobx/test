<?php


namespace App\Presenters;


class FieldPresenter extends Presenter
{
    public function value()
    {
        if(! $this->entity->pivot) {
            return '---';
        }

        $value = $this->entity->pivot->value;

        if (strtolower($this->entity->name) === 'interest rate') {
            return $value . '%';
        }

        if ($this->entity->options()->count()) {
            $option = $this->entity->options()->find($this->pivot->value);

            return $option ? $option->translate()->name : '---';
        }

        if (! is_numeric($value)) {
            return $value;
        }

        $units = str_replace('%/', '', $this->entity->translate()->unit);

        return $value . ' ' . $units;
    }
}
