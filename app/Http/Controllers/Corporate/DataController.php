<?php

namespace App\Http\Controllers\Corporate;

use App\ListingField;
use App\PendingData;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataController extends CorporateController
{
    /**
     * DataController constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        parent::__construct($guard);
        $this->authorize('approve-data');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $pendingModels = $this->corporate->pendingData()->with('user')->paginate(20);

        return view('corporate.pending.index', compact('pendingModels'));
    }

    /**
     * @param PendingData $pending
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(PendingData $pending)
    {
        $modifications = json_decode($pending->attributes, true);
        //dd($modifications);
        if($pending->pending_type == 'App\Listing') {
            $translations = [];
            $fields = [];

            foreach($modifications['translations'] as $attribute) {
                $translations[$attribute['translatable_attribute']] = $attribute['translation'];
            }

            foreach($modifications['fields'] as $key => $field) {
                $fields[$key]['name'] = ListingField::findOrFail($key)->name;
                $fields[$key]['value'] = $field['value'];
            }
        }

        return view('corporate.pending.show', compact('pending', 'modifications', 'translations', 'fields'));
    }

    /**
     * @param PendingData $pendingData
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(PendingData $pendingData)
    {
        $this->authorize('approve-data');
        $pendingData->apply();

        return redirect()->route('backend.corporate.data.requests.index')->with('success', 'Data Request approved.');
    }

    /**
     * @param PendingData $pendingData
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deny(PendingData $pendingData, Request $request)
    {
        $route = '';

        if(in_array($pendingData->type, ['update', 'delete'])) {
            switch ($pendingData->pending_type) {
                case 'App\CorporateBranch': $route = route('backend.corporate.branches.edit', $pendingData->pendingModel->id); break;
                case 'App\CorporateDetails': $route = route('backend.corporate.details.index'); break;
                case 'App\CorporateSlider': $route = route('backend.corporate.sliders.index'); break;
                case 'App\Listing': $route = route('backend.corporate.listings.edit', $pendingData->pendingModel->id); break;
            }
        }
        if($pendingData->type == 'create') {
            switch ($pendingData->pending_type) {
                case 'App\CorporateBranch': $route = route('backend.corporate.branches.create'); break;
                case 'App\CorporateDetails': $route = route('backend.corporate.details.index'); break;
                case 'App\CorporateSlider': $route = route('backend.corporate.sliders.index'); break;
                case 'App\Listing': $route = route('backend.corporate.listings.create'); break;
            }
        }

        $pendingData->user->notify([
            'body' => "Your Request for Modifications has been denied:\n" . $request->get('description'),
            'type' => 'Modifying request',
            'icon' => 'fa fa-envelope',
            'url'  =>  $route
        ]);

        $pendingData->delete();

        return redirect()->route('backend.corporate.data.requests.index')->with('success', 'Data Request denied.');
    }
}
