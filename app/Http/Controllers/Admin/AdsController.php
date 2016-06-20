<?php

namespace App\Http\Controllers\Admin;

use App\Advertisement;
use App\AdvertisementSpot;
use App\Corporate;
use App\Helpers\AdHelper;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\AdvertisementRequest;
use App\Service;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Advertisement::with('corporate')->paginate(25);

        return view('admin.advertisements.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::get();
        $spots = AdvertisementSpot::get();
        $corporates = Corporate::lists('name', 'id');

        return view('admin.advertisements.create', compact('services', 'spots', 'corporates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdvertisementRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request)
    {
        $ad = Advertisement::create($request->input());

        $ad->addTranslation([
            'translatable_attribute' => 'image',
            'translation' => $request->get('image_ar')
        ]);

        $ad->advertise($request->get('spots'));

        return redirect()->route('backend.admin.advertisements.index')
                         ->with('success', 'Ad created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Advertisement $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $ad)
    {
        $services = Service::get();
        $spots = AdvertisementSpot::get();
        $corporates = Corporate::lists('name', 'id');
        $ad->load('spots');

        return view('admin.advertisements.edit', compact('ad', 'services', 'spots', 'corporates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdvertisementRequest|Request $request
     * @param Advertisement $ad
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementRequest $request, Advertisement $ad)
    {
        $ad->update($request->input());
        $ad->advertise($request->get('spots'));

        $ad->updateTranslation('image', $request->get('image_ar'));

        return redirect()->route('backend.admin.advertisements.index')
                         ->with('success', 'Ad updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Advertisement $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $ad)
    {
        ImageHelper::delete($ad->image);
        ImageHelper::delete($ad->translate('ar')->image);

        $ad->delete();

        return redirect()->route('backend.admin.advertisements.index')
                         ->with('success', 'Ad deleted successfully.');
    }
}
