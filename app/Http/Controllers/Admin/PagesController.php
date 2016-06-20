<?php

namespace App\Http\Controllers\Admin;

use App\CorporateType;
use App\Service;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * @return mixed
     */
    public function learn()
    {
        $corporateTypes = CorporateType::with('services')->get();
        
        return view('admin.learn.index', compact('corporateTypes'));
    }

    /**
     * @return mixed
     */
    public function corporateTypes()
    {
        $types = CorporateType::get();
        
        return view('admin.corporateTypes.index', compact('types'));
    }
}
