<?php

namespace App\Http\Controllers;

use App\Corporate;
use Illuminate\Http\Request;

use App\Http\Requests;

class CorporatesController extends Controller
{
    /**
     * Shows a corporate page.
     * 
     * @param Corporate $corporate
     * @return mixed
     */
    public function show(Corporate $corporate)
    {
        $corporate->load([
            'type.services.listings' => function($q) use ($corporate) {
                $q->where('corporate_id', $corporate->id);
            },
            'branches',
            'sliders',
        ]);

        return view('corporate', compact('corporate'));
    }
}
