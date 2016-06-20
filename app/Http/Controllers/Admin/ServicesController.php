<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * @param Request $request
     * @param Service $service
     */
    public function updateVideo(Request $request, Service $service)
    {
        $this->validate($request, [
            'url' => 'active_url'
        ]);

        $youtubeId = getYoutubeId($request->get('url'));
        if(! $youtubeId) {
            return redirect()->back()->withErrors('Wrong youtube link format');
        }

        $service->video_url = "https://www.youtube.com/embed/{$youtubeId}";
        $service->save();

        return redirect()->back()
                         ->with('success', "{$service->name} Video Url updated successfully.");
    }
}
