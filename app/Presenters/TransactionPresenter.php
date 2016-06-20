<?php

namespace App\Presenters;

class TransactionPresenter extends Presenter
{
    /**
     * Presents the method attribute.
     *
     * @return string
     */
    public function method()
    {
        switch ($this->entity->method) {
            case 1: return 'Cash';
            case 2: return 'Credit Card';

            default: return '---';
        }
    }

    /**
     * Presents the status attribute.
     *
     * @return string
     */
    public function status()
    {
        switch ($this->entity->status) {
            case 1: return 'Failed';
            case 2: return 'Success';

            default: return 'Pending';
        }
    }
}
