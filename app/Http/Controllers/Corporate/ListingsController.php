<?php

namespace App\Http\Controllers\Corporate;

use App\Filters\Admin\ListingFilter;
use App\Http\Requests;
use App\Http\Requests\ListingRequest;
use App\Listing;
use App\Service;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ListingsController extends CorporateController
{
    /**
     * Display a listing of the resource.
     *
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function index(Service $service)
    {
        try {
            $this->authorize($service);
        }

        catch (AuthorizationException $exception) {
            return redirect()->route('backend.corporate.index')
                             ->withErrors('Your Corporate does not have access to that service.');
        }

        $listings = $service->listings()
                            ->where('corporate_id', $this->corporate->id)
                            ->paginate(20);

        return view('corporate.listings.index', compact('listings', 'service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function create(Service $service)
    {
        try {
            $this->authorize('store', $service);
        }

        catch (AuthorizationException $exception) {
            return redirect()->route('backend.corporate.index')
                             ->withErrors('Your Corporate does not have access to that service.');
        }

        $fields = $service->listingFields()->with('translations', 'options.translations')->get();

        return view('corporate.listings.create', compact('service', 'fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ListingRequest|Request $request
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function store(ListingRequest $request, Service $service)
    {
        try {
            $this->authorize('store', $service);
        }

        catch (AuthorizationException $exception) {
            return redirect()->route('backend.corporate.index')
                             ->withErrors('Your Corporate does not have access to that service.');
        }

        $transformed = $this->transformRequest($request);

        if ($request->user()->is_corporate('manager')) {
            $listing = $service->listings()->create($request->input() + ['corporate_id' => $this->corporate->id]);

            $listing->createTranslation('name', $request->get('name_ar'));
            $listing->createTranslation('overview', $request->get('overview_ar'));
            $listing->createTranslation('offers', $request->get('offers_ar'));
            $listing->createTranslation('documents', $request->get('documents_ar'));
            $listing->createTranslation('benefits', $request->get('benefits_ar'));
            $listing->createTranslation('eligibility', $request->get('eligibility_ar'));
            $listing->createTranslation('details', $request->get('details_ar'));


            $listing->fields()->attach($transformed);
            $listing->addPhotos($request->get('slides'));

            return redirect()->route('backend.corporate.listings.index', $service->id)
                             ->with('success', 'Created listing successfully.');
        }

        $translations = $this->getTranslationsFromRequest($request);

        Listing::requestCreate([
            'data' => $request->except([
                'fields', 'name_ar', 'overview_ar',
                'offers_ar', 'documents_ar', 'benefits_ar',
                'eligibility_ar', 'details_ar'
            ]),
            'fields' => $transformed,
            'photos' => $request->get('slides'),
            'translations' => $translations,
            'service_id' => $service->id
        ]);

        return redirect()->route('backend.corporate.listings.index', $service->id)
                         ->with('success', 'Listing create request submitted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @param Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service, Listing $listing)
    {
        try {
            $this->authorize('update', $service);
        }

        catch (AuthorizationException $exception) {
            return redirect()->route('backend.corporate.index')
                             ->withErrors('Your Corporate does not have access to that service.');
        }

        $listing->load('fields.translations');
        $fields = $this->verifyFields($listing);

        return view('corporate.listings.edit', compact('listing', 'service', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ListingRequest|Request $request
     * @param Service $service
     * @param Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function update(ListingRequest $request, Service $service, Listing $listing)
    {
        try {
            $this->authorize($service);
        }

        catch (AuthorizationException $exception) {
            return redirect()->route('backend.corporate.index')
                             ->withErrors('Your Corporate does not have access to that service.');
        }

        $transformed = $this->transformRequest($request);

        if ($request->user()->is_corporate('manager')) {

            $listing->update($request->all());
            $listing->fields()->sync($transformed);
            $listing->addPhotos($request->get('slides'));

            $listing->updateTranslation('name', $request->get('name_ar'));
            $listing->updateTranslation('overview', $request->get('overview_ar'));
            $listing->updateTranslation('offers', $request->get('offers_ar'));
            $listing->updateTranslation('documents', $request->get('documents_ar'));
            $listing->updateTranslation('benefits', $request->get('benefits_ar'));
            $listing->updateTranslation('eligibility', $request->get('eligibility_ar'));
            $listing->updateTranslation('details', $request->get('details_ar'));

            return redirect()->route('backend.corporate.listings.index', $service->id)
                             ->with('success', 'updated listing successfully.');
        }

        $data = [
            'fields' => $transformed,
            'translations' => $this->getTranslationsFromRequest($request),
            'photos' => $request->get('slides'),
            'data' => $request->except([
                'fields', 'name_ar', 'overview_ar',
                'offers_ar', 'documents_ar', 'benefits_ar',
                'eligibility_ar', 'details_ar'
            ])
        ];

        $listing->requestUpdate($data);

        return redirect()->route('backend.corporate.listings.index', $service->id)
                         ->with('success', 'Listing update request submitted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @param Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service, Listing $listing)
    {
        try {
            $this->authorize($service);
        }

        catch (AuthorizationException $exception) {
            return redirect()->route('backend.corporate.index')
                             ->withErrors('Your Corporate does not have access to that service.');
        }

        if ($this->signedUser->is_corporate('manager')) {
            $listing->delete();

            return redirect()->route('backend.corporate.listings.index', $service->id)
                             ->with('success', 'Deleted listing successfully.');
        }

        $listing->requestDelete();

        return redirect()->route('backend.corporate.listings.index', $service->id)
                         ->with('success', 'Listing delete request submitted successfully.');
    }

    /**
     * @param Request $request
     * @param ListingFilter $filter
     * @return mixed
     */
    public function sponsored(Request $request, ListingFilter $filter)
    {
        $listings = $this->corporate->listings()
                                    ->with('service')
                                    ->filter($filter)
                                    ->paginate(20)->appends($request->except('page'));

        $services = $this->corporate->type->services()->lists('name', 'id');

        return view('corporate.listings.sponsored', compact('listings', 'services'));
    }

    /**
     * @param Request $request
     * @return array
     */
    private function transformRequest(Request $request)
    {
        $transformed = [];

        foreach ($request->get('fields') as $id => $value) {
            $transformed[$id] = ['value' => is_array($value) ? $value[0] : $value];
        }

        return $transformed;
    }

    /**
     * @param Listing $listing
     * @return array
     */
    public function transformOld(Listing $listing) {
        $transformed = [];

        foreach ($listing->fields as $field) {
            $transformed[$field->id] = ['value' => $field->pivot->value];
        }

        return $transformed;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getTranslationsFromRequest(Request $request)
    {
        $translations = [
            ['translatable_attribute' => 'name', 'translation' => $request->get('name_ar')],
            ['translatable_attribute' => 'overview', 'translation' => $request->get('overview_ar')],
            ['translatable_attribute' => 'offers', 'translation' => $request->get('offers_ar')],
            ['translatable_attribute' => 'documents', 'translation' => $request->get('documents_ar')],
            ['translatable_attribute' => 'benefits', 'translation' => $request->get('benefits_ar')],
            ['translatable_attribute' => 'eligibility', 'translation' => $request->get('eligibility_ar')],
            ['translatable_attribute' => 'details', 'translation' => $request->get('details_ar')]
        ];

        return $translations;
    }

    public function duplicate(Service $service, Listing $oldListing)
    {
        try {
            $this->authorize('store', $service);
        }

        catch (AuthorizationException $exception) {
            return redirect()->route('backend.corporate.index')
                ->withErrors('Your Corporate does not have access to that service.');
        }

        $transformed = $this->transformOld($oldListing);

        $listing = $service->listings()->create([
            'name' => $oldListing->name,
            'overview' => $oldListing->overview,
            'offers' => $oldListing->offers,
            'details' => $oldListing->details,
            'benefits' => $oldListing->benefits,
            'eligibility' => $oldListing->eligibility,
            'documents' => $oldListing->documents,
            'featured' => $oldListing->featured,
            'url' => $oldListing->url,
            'corporate_id' => $this->corporate->id
        ]);

        $listing->createTranslation('name', $oldListing->translate('ar')->name);
        $listing->createTranslation('overview', $oldListing->translate('ar')->overview);
        $listing->createTranslation('offers', $oldListing->translate('ar')->offers);
        $listing->createTranslation('documents', $oldListing->translate('ar')->documents);
        $listing->createTranslation('benefits', $oldListing->translate('ar')->benefits);
        $listing->createTranslation('eligibility', $oldListing->translate('ar')->eligibility);
        $listing->createTranslation('details', $oldListing->translate('ar')->details);

        $listing->fields()->attach($transformed);

        $photos = [];
        foreach($oldListing->photos as $photo) {
            $photos[$photo->id] = [
                'name' => $photo->name,
                'caption' => $photo->caption,
                'title' => isset($photo->title) ? $photo->title : null
            ];
        }
        $listing->addPhotos($photos);

        return redirect()->route('backend.corporate.listings.edit', [$service->id, $listing->id])->with('success', 'Created listing successfully.');
    }

    /**
     * Makes sure if any field failed to attach like checkboxes, it includes it
     * in the form for possible reattachment.
     * @param $listing
     * @return
     */
    protected function verifyFields(Listing $listing)
    {
        $listingFields = $listing->fields;
        $fields = $listingFields;

        if($listingFields->count() != $listing->service->listingFields()->count()) {
            $listing->load('service.listingFields');
            $fields = [];

            foreach($listing->service->listingFields as $field) {
                $field->pivot = new \stdClass();
                $listingField = $listingFields->find($field->id);

                $field->pivot->value = $listingField ? $listingField->pivot->value : '';

                $fields[] = $field;
            }
        }

        return collect($fields);
    }
}
