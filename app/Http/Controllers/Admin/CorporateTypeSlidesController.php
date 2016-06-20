<?php

namespace App\Http\Controllers\Admin;

use App\CorporateType;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Photo;
use Illuminate\Http\Request;

class CorporateTypeSlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @param CorporateType $type
     * @return \Illuminate\Http\Response
     */
    public function index(CorporateType $type)
    {
        $slides = $type->photos()->paginate(25);

        return view('admin.corporateTypes.photos.index', compact('slides', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CorporateType $type
     * @return \Illuminate\Http\Response
     */
    public function create(CorporateType $type)
    {
        return view('admin.corporateTypes.photos.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CorporateType $type
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CorporateType $type)
    {
        $count = $type->addPhotos($request->get('slides'));

        return redirect()->route('backend.admin.corporate-types.photos.index', $type->slug)
                         ->with('success', "{$count} Slides added successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CorporateType $type
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(CorporateType $type, Photo $photo)
    {
        return view('admin.corporateTypes.photos.edit', compact('type', 'photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CorporateType $type
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CorporateType $type, Photo $photo)
    {
        $imageName = $photo->name;

        $photo->update($request->input());
        $photo->updateTranslation('caption', $request->get('caption_ar'));
        $photo->updateTranslation('title', $request->get('title_ar'));

        return redirect()->route('backend.admin.corporate-types.photos.index', $type->slug)
                         ->with('success', "Photo updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CorporateType $type
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CorporateType $type, Photo $photo)
    {
        $photo->delete();

        return redirect()->route('backend.admin.corporate-types.photos.index', $type->slug)
                         ->with('success', "Slide deleted successfully.");
    }
}
