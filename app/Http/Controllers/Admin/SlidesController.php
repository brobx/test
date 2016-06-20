<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Photo;
use App\Service;
use Illuminate\Http\Request;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function index(Service $service)
    {
        $slides = $service->photos()->paginate(25);

        return view('admin.learn.photos.index', compact('slides', 'service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function create(Service $service)
    {
        return view('admin.learn.photos.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Service $service)
    {
        $count = $service->addPhotos($request->get('slides'));

        return redirect()->route('backend.admin.learn.photos.index', $service->id)
                         ->with('success', "{$count} Slides added successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service, Photo $photo)
    {
        return view('admin.learn.photos.edit', compact('service', 'photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Service $service
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service, Photo $photo)
    {
        $photo->update($request->all());
        $photo->updateTranslation('caption', $request->get('caption_ar'));

        return redirect()->route('backend.admin.learn.photos.index', $service->id)
                         ->with('success', "Photo updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service, Photo $photo)
    {
        $photo->delete();

        return redirect()->route('backend.admin.learn.photos.index', $service->id)
                         ->with('success', "Slide deleted successfully.");
    }
}
