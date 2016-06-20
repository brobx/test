<?php

namespace App\Policies;

use App\Exceptions\ListingTimeWindowNotExpired;
use App\Exceptions\UserDidNotApplyException;
use App\Lead;
use App\Listing;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function apply(User $user, Listing $listing)
    {
        return ! $user->hasApplied($listing);
    }

    /**
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function cancel(User $user, Listing $listing)
    {
        return $user->hasApplied($listing);
    }

    /**
     * @param User $user
     * @param Listing $listing
     * @return bool
     */
    public function buy(User $user, Listing $listing)
    {
        return $user && $listing->corporate->type_id == 3;
    }

    /**
     * @param User $user
     * @param Listing $listing
     * @return bool
     * @throws UserDidNotApplyException
     */
    public function rate(User $user, Listing $listing)
    {
        $lead = $user->leads()
                     ->unrated()
                     ->pending()
                     ->where('listing_id', $listing->id)
                     ->first();

        if(! $lead) {
            throw new UserDidNotApplyException("User didn't apply to this listing.");
        }

        $this->checkTimeWindow($lead, $listing);

        return true;
    }

    /**
     * @param Lead $lead
     * @param Listing $listing
     * @return bool
     * @throws ListingTimeWindowNotExpired
     */
    private function checkTimeWindow(Lead $lead, Listing $listing)
    {
        $slug = $listing->corporate->type->slug;

        if($slug == 'travel' && Carbon::createFromFormat('d-m-Y' , $listing->getFieldValue('Return Date'))->isFuture()) {
            throw new ListingTimeWindowNotExpired('User Cannot rate this listing just yet.');
        }

        if ($slug == 'banking' && $lead->created_at->addDays($listing->getFieldValue('Average Processing Time'))->isFuture()) {
            throw new ListingTimeWindowNotExpired('User Cannot rate this listing just yet.');
        }

        return true;
    }
}
