<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserApplied extends Event
{
    /**
     * @var
     */
    public $user;

    /**
     * @var
     */
    public $lead;

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @param $lead
     */
    public function __construct($user, $lead)
    {
        $this->user = $user;
        $this->lead = $lead;
    }
}
