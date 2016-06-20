<?php

namespace App\Presenters;

class ListingPresenter extends Presenter
{
    /**
     * @return string
     */
    public function sponsorshipStatus()
    {
        if(! $this->entity->featured) {
            return "<span class='label label-danger'>Not Sponsored</span>";
        }
        
        if ($this->entity->targeted_impressions <= $this->entity->impressions) {
            return "<span class='label bg-gray'>Inactive</span>";
        }

        return "<span class='label label-success'>Sponsored</span>";
    }
}