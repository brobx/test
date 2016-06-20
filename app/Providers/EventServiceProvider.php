<?php

namespace App\Providers;

use App\Helpers\AdHelper;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegistered' => [
            'App\Listeners\SendWelcomeEmail',
        ],
        'App\Events\UserApplied' => [
            'App\Listeners\SendConfirmApplicationEmail',
            'App\Listeners\NotifyCorporateAdmin'
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $events->listen(RouteMatched::class, function ($route) {
            AdHelper::injectAdsToViews();
        });
    }
}
