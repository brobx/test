<?php

namespace App\Providers;

use App\Filters\Services\Contracts\QueryFilter;
use App\Filters\Services\QueryFilter as QueryObjectConcrete;
use App\Http\Requests\Request;
use App\Http\Routing\ResourceNoPrefixRegistrar;
use App\Settings;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('old_password', function($attribute, $value, $parameters)
        {
            return Hash::check($value, auth()->user()->getAuthPassword());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(ResourceRegistrar::class, function ()
        {
            return app(ResourceNoPrefixRegistrar::class);
        });

        $this->app->bind(QueryFilter::class, function () {
            return QueryObjectConcrete::makeQueryObject();
        });

        $this->app->singleton(Settings::class, function () {
            return new Settings(auth()->user());
        });
    }
}
