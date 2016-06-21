<?php

namespace App\Http\Controllers;

use App\CorporateType;
use App\Events\UserApplied;
use App\Exceptions\ListingTimeWindowNotExpired;
use App\Exceptions\UserDidNotApplyException;
use App\Filters\Services\QueryFilter;
use App\Http\Requests;
use App\Http\Requests\LeadRequest;
use App\Listing;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    /**
     * @param Listing $listing
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Listing $listing)
    {
        $listing->load('service', 'corporate');
        $listing->increment('views');

        return view('listings.show', compact('listing'));
    }

    /**
     * @param Listing $listing
     * @return mixed
     */
    public function getApply(Listing $listing)
    {
        if(auth()->check()) {
            try {
                $this->authorize('apply', $listing);
            }

            catch (AuthorizationException $ex) {
                return redirect()->route('listing.apply.completed', $listing->id);
            }
        }

        $listing->load('service', 'corporate');

        return view('apply', compact('listing'));
    }

    /**
     * @param Requests\LeadRequest $request
     * @param Listing $listing
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postApply(LeadRequest $request, Listing $listing)
    {
        try {
            $this->authorize('apply', $listing);
        }

        catch (AuthorizationException $ex) {
            return redirect()->route('listing.apply.completed', $listing->id);
        }

        $type = $request->get('type');

        event(new UserApplied($request->user(), $listing->apply($request)));

        switch ($type) {
            case 'branch':
                return redirect()->route('corporates.show', $listing->corporate_id);
            case 'online':
                return redirect($listing->url);
            default:
                return redirect()->route('listing.apply.completed', $listing->id);
        }
    }

    /**
     * @param Listing $listing
     * @param Guard $guard
     * @return mixed
     */
    public function getCompleted(Listing $listing, Guard $guard)
    {
        try {
            $this->authorize('cancel', $listing);
        }

        catch (AuthorizationException $ex) {
            return redirect()->route('listing.apply', $listing->id);
        }

        $lead = $guard->user()->leads()->pending()->where('listing_id', $listing->id)->first();
        $listing->load('service', 'corporate');
        $industries = CorporateType::with('translations', 'services.translations')->get();

        return view('apply-3', compact('listing', 'industries', 'lead'));
    }

    /**
     * @param Listing $listing
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getRate(Listing $listing)
    {
        try {
            $this->authorize('rate', $listing);
        }

        catch (UserDidNotApplyException $ex) {
            return redirect()->route('listing.apply', $listing->id);
        }

        catch (ListingTimeWindowNotExpired $ex) {
            return redirect()->route('home');
        }

        $ratingParameters = QueryFilter::makeQueryObject($listing->service_id)->getRatingParameters();

        return view('pages.rate', compact('listing', 'ratingParameters'));
    }

    /**
     * @param Request $request
     * @param Listing $listing
     * @param Guard $guard
     * @return
     */
    public function postRate(Request $request, Listing $listing, Guard $guard)
    {
        try {
            $this->authorize('rate', $listing);
        }

        catch (UserDidNotApplyException $ex) {
            return redirect()->route('listing.apply', $listing->id);
        }

        catch (ListingTimeWindowNotExpired $ex) {
            return redirect()->route('home');
        }

        $lead = $guard->user()
                      ->leads()
                      ->unrated()
                      ->pending()
                      ->where('listing_id', $listing->id)
                      ->first();

        $listing->review($lead, collect($request->get('parameters'))->avg());

        return redirect()->route('account.index')
                         ->with('success', 'Thanks for your review');
    }

    /**
     * @param Listing $listing
     * @param Guard $guard
     * @return
     */
    public function compareListing(Listing $listing, Guard $guard)
    {
        $user = $guard->user();

        if (! $user->listings()->where('id', $listing->id)->exists()) {
            $user->listings()->attach($listing->id);
        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Listing $listing
     * @param Guard $guard
     * @return mixed
     */
    public function removeFromComparison(Listing $listing, Guard $guard)
    {
        $guard->user()
              ->listings()
              ->detach($listing->id);

        return response()->json([
            'success' => true
        ]);
    }
}
