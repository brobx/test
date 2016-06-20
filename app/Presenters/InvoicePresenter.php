<?php


namespace App\Presenters;


class InvoicePresenter extends Presenter
{
    /**
     * @return mixed
     */
    public function dueDate()
    {
        return $this->entity->created_at->endOfMonth()->format('d-m-Y');
    }

    /**
     * @return mixed
     */
    public function fromDate()
    {
        return $this->entity->created_at->startOfMonth()->format('d-m-Y');
    }
}