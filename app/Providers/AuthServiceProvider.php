<?php

namespace App\Providers;

use App\Invoice;
use App\Lead;
use App\Listing;
use App\Policies\InvoicePolicy;
use App\Policies\LeadPolicy;
use App\Policies\ListingPolicy;
use App\Policies\ServicePolicy;
use App\Service;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Listing::class => ListingPolicy::class,
        Lead::class => LeadPolicy::class,
        Invoice::class => InvoicePolicy::class,
        Service::class => ServicePolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        
        $gate->define('approve-data', function ($user) {
            return $user->is_corporate('manager');
        });

        $gate->define('manage-corporate', function ($user) {
            return $user->is_corporate('manager');
        });

        $gate->define('data-entry', function ($user) {
            return $user->is_corporate('data-entry');
        });
    }
}
