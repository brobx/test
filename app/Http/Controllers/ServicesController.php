<?php

namespace App\Http\Controllers;

use App\Filters\Services\Contracts\QueryFilter;
use App\Http\Requests;
use App\Review;
use App\Service;
use App\Transformers\ListingTransformer;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * @param Service $service
     * @param QueryFilter $filters
     * @param Request $request
     * @return mixed
     */
    public function listings(Service $service, QueryFilter $filters, Request $request)
    {
        $service->load([
            'topics.translations',
            'topics' => function ($query) {
                $query->orderBy('priority', 'asc');
            }
        ]);

        $listings = $service->listings()->filter($filters)->paginate(10);
        $fields = $filters->getAdvancedSearchFields();

        $listings->appends($request->except('page'));
        $highlights = $filters->getComparisonFields();
        $featuredListing = $service->listings()->featured()->orderByRaw('RAND()')->first();
        if(@$request->user()) {
            $comparisons = (new ListingTransformer())->transform(
                $request->user()
                        ->listings()
                        ->with('corporate.details')
                        ->where('service_id', $service->id)
                        ->get()
            );
        }
        $reviews = [];
        $reviewsObj = new Review();
        foreach ($listings as $item) {
            $reviews[$item->id][] = $reviewsObj->getReviewByListingId($item->id);
        }

        return view('listings.index', compact('listings', 'service', 'fields', 'highlights', 'featuredListing',
            'comparisons', 'reviews'));
    }

    /**
     * @param Service $service
     * @param Guard $guard
     * @param Request $request
     * @param QueryFilter $filters
     * @return mixed
     */
    public function comparison(Service $service, Guard $guard, Request $request, QueryFilter $filters)
    {
        $listings = $guard->user()
                          ->listings()
                          ->where('service_id', $service->id)
                          ->filter($filters)
                          ->paginate(10)
                          ->appends($request->except('page'));

        $highlights = $filters->getComparisonFields();
        $fields = $filters->getAdvancedSearchFields();

        return view('listings.index', compact('listings', 'service', 'fields', 'highlights'));
    }
}
