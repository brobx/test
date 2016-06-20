<?php

namespace App\Http\Controllers\Corporate;

use App\Corporate;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Auth\Guard;

abstract class CorporateController extends Controller
{
    /**
     * @var Corporate|null
     */
    protected $corporate = null;

    /**
     * @var User|null
     */
    protected $signedUser = null;

    /**
     * @var null
     */
    protected $services = null;

    /**
     * CorporateController constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {

        $this->signedUser = $guard->user();
        $this->corporate = $this->signedUser->corporate;
        $this->services = $this->corporate->type->services;
        view()->share('currentCorporate', $this->corporate);
        view()->share('signedUser', $this->signedUser);
        view()->share('industryServices', $this->services);

        if($this->signedUser->is_corporate('manager')) {
            view()->share('dataRequestsCount', $this->corporate->pendingData()->count());
        }

        view()->share('navNotifications', $this->signedUser->notifications()->latest()->limit(5)->get());
        view()->share('newNotifications', $this->signedUser->notifications()->unread()->count());
        view()->share('invoicesCount', $this->corporate->invoices()->unpaid()->count());
    }
}