<?php

namespace App\Http\Controllers\Admin;

use App\Corporate;
use App\Filters\Admin\ListingFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Listing;
use App\Service;

class ListingsController extends Controller
{
    /**
     * @param Request $request
     * @param ListingFilter $filter
     * @return mixed
     */
    public function index(Request $request, ListingFilter $filter)
    {
        $listings = Listing::with('corporate', 'service')
                           ->filter($filter)
                           ->paginate(20)->appends($request->except('page'));

        $corporates = Corporate::lists('name', 'id');
        $services = Service::lists('name', 'id');

        return view('admin.listings.index', compact('listings', 'corporates', 'services'));
    }

    /**
     * @param Listing $listing
     * @param Request $request
     * @return mixed
     */
    public function feature(Listing $listing, Request $request)
    {
        $listing->featured = ! $listing->featured;
        if ($request->has('targeted_impressions')) {
            $listing->targeted_impressions = $request->get('targeted_impressions');
        }

        $listing->save();

        return redirect()->route('backend.admin.listings.index')
                         ->with('success', 'Listing was featured');
    }
}
