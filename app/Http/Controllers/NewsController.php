<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\AdvertisementSpot;
use App\PostCategory;
use App\Post;

class NewsController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
    	$categories = PostCategory::with(['posts' => function($query) {
            $query->orderBy('created_at', 'desc')->limit(2);
        }])->get();

    	return view('news', compact('categories'));
    }

    /**
     * @param PostCategory $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexCategory(PostCategory $category)
    {
        $category = $category->load(['posts' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('newsOfCategory', compact('category'));
    }

    /**
     * @param $postId
     * @return mixed
     * @internal param Post $post
     */
    public function show($postId)
    {
        $post = Post::findOrFail($postId);

    	return view('post', compact('post'));
    }
}
