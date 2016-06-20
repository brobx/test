<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Requests;

class PagesController extends CorporateController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $services = $this->corporate->type->services;
        $tabs = ['weekly', 'monthly', 'yearly'];

        foreach ($services as $service) {
            $service->featuredCount = $service->listings()
                                              ->ownedByCorporate($this->corporate->id)
                                              ->featured()
                                              ->count();
            
            $service->listingsCount = $service->listings()
                                              ->ownedByCorporate($this->corporate->id)
                                              ->count();

            $service->views = $service->listings()
                                              ->ownedByCorporate($this->corporate->id)
                                              ->sum('views');
        }

        $ads = collect([
            'active' => $this->corporate->advertisements()->active()->count(),
            'inactive' => $this->corporate->advertisements()->active()->count()
        ]);

        return view('corporate.pages.index', compact('services', 'tabs', 'ads'));
    }
}
