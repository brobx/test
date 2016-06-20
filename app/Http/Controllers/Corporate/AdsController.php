<?php

namespace App\Http\Controllers\Corporate;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdsController extends CorporateController
{
    /**
     * @return mixed
     */
    public function index()
    {
        $ads = $this->corporate->advertisements()->paginate(20);

        return view('corporate.advertisements.index', compact('ads'));
    }
}
