<?php

namespace App\Http\Controllers;

use App\CorporateType;
use App\Http\Requests;
use App\Post;
use App\PostCategory;
use App\Transformers\ServiceTransformer;
use App\Transformers\ServiceTypeTransformer;
use Illuminate\Http\Request;

// use App\CorporateType;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicesTypes = CorporateType::with('services')->get();

        return view('home', compact('servicesTypes'));
    }

    /**
     * @param CorporateType $type
     * @param ServiceTransformer $serviceTransformer
     * @param ServiceTypeTransformer $typeTransformer
     * @return mixed
     */
    public function industry(CorporateType $type, ServiceTransformer $serviceTransformer, ServiceTypeTransformer $typeTransformer)
    {
        $categories = null;
        $services = null;

        $latestPost = $type->posts()->orderBy('created_at', 'desc')->first();
        
        if(isset($latestPost)) {
            $post['id'] = $latestPost->id;
            $post['title'] = $latestPost->translate()->title;
            $post['body'] = strip_tags($latestPost->translate()->body);
            if (strlen($post['body']) > 200) {
                $post['body'] = substr($post['body'], 0, 200) . '... <a href="' . route('news.show', $post['id']) . '">' . trans('main.readmore') . '</a>';

            }
        }

        $slides = $type->photos;
        $types = $type->serviceTypes()->with('services')->get();
        $corporates = $type->partners()->with('details')->get();
        
        if($types->count()) {
            $categories = $typeTransformer->with('services')->transform($types);
        }

        if(! $categories) {
            $services = $serviceTransformer->transform($type->services);
        }

        $categories = $categories ? json_encode($categories) : null;
        $services = ! $categories ? json_encode($services) : null;

        return view('homeProduct', compact('categories', 'services', 'corporates', 'slides', 'type', 'post'));
    }
}
