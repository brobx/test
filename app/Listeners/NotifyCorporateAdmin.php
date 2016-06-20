<?php

namespace App\Listeners;

use App\Events\UserApplied;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Filters\Services\QueryFilter;

class NotifyCorporateAdmin
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
     * @param  UserApplied  $event
     * @return void
     */
    public function handle(UserApplied $event)
    {
        $highlights = QueryFilter::makeQueryObject($event->lead->listing->service_id)
                                 ->getComparisonFields();

        $manager = $event->lead->listing->corporate->manager;
        $manager->notify([
            'body' => "You have a new application request",
            'type' => 'application',
            'icon' => 'fa fa-envelope',
            'url' => route('backend.corporate.leads.index')
        ]);

        $email = $manager->corporate->details->call_center_email ?: $manager->email;

        $this->mailer->send('emails.applications.admin', [
            'user' => $event->user,
            'lead' => $event->lead,
            'listing' => $event->lead->listing,
            'highlights' => $highlights
        ],
            function ($m) use ($manager, $email) {
                $m->to($email, $manager->name)->subject('You have a new application');
            });
    }
}
