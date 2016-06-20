<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Create the event listener.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $this->mailer->send('emails.welcome', ['user' => $event->user, 'password' => $event->randomPassword], function ($m) use($event)
        {
            $m->to($event->user->email, $event->user->name)->subject('Welcome to Qarenhom');
        });
    }
}
