<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @var bool
     */
    public $randomPassword;

    /**
     * Create a new event instance.
     * @param $user
     * @param null $randomPassword
     */
    public function __construct($user, $randomPassword = null)
    {
        $this->user = $user;
        $this->randomPassword = $randomPassword;
    }
}
