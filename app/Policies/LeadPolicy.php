<?php

namespace App\Policies;

use App\Lead;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Lead $lead
     * @return bool
     */
    public function cancel(User $user, Lead $lead)
    {
        return $user->id == $lead->user_id && ! $lead->review;
    }
}
