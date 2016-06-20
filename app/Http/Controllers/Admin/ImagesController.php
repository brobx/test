<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    /**
     * Saves the logo image.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $helper = ImageHelper::fromRequest($request);
        $name = $helper->save();

        return response()->json([
            'name' => $name
        ]);
    }

    /**
     * Removes an image from uploads folder.
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($name)
    {
        ImageHelper::delete($name);

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToSlider(Request $request)
    {
        $helper = ImageHelper::fromRequest($request);
        $name = $helper->save();

        return response()->json([
            'slider' => [
                'image' => $name,
            ]
        ]);
    }
}
