<?php

namespace App\Http\Controllers;

use App\CorporateType;
use App\Service;
use Illuminate\Http\Request;

use App\Http\Requests;

class LearnController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $types = CorporateType::with('services.translations', 'translations')->get();

        return view('learn', compact('types'));
    }

    /**
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Service $service)
    {
        $service->load(
            ['topics' => function($query) {$query->orderBy('priority', 'asc');}, 'photos']
        );
        
        return view('learnSingle', compact('service'));
    }
}
