<?php

namespace App\Listeners;

use App\Events\UserApplied;
use App\Filters\Services\QueryFilter;
use Illuminate\Mail\Mailer;

class SendConfirmApplicationEmail
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserApplied $event
     * @return void
     */
    public function handle(UserApplied $event)
    {
        $highlights = QueryFilter::makeQueryObject($event->lead->listing->service_id)
                                 ->getComparisonFields();

        $this->mailer->send('emails.applications.user', [
            'user' => $event->user,
            'lead' => $event->lead,
            'listing' => $event->lead->listing,
            'highlights' => $highlights
        ],
            function ($m) use ($event) {
                $m->to($event->user->email, $event->user->name)->subject('Application Confirmation');
            });
    }
}
