<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Post;
use App\PostCategory;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostCategory::lists('title', 'id');

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = $request->user()->posts()->create($request->input());
        $post->addTranslation([
            'translatable_attribute' => 'title',
            'translation' => $request->get('title_ar')
        ]);

        $post->addTranslation([
            'translatable_attribute' => 'body',
            'translation' => $request->get('body_ar')
        ]);

        return redirect()->route('backend.admin.posts.index')
                         ->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = PostCategory::lists('title', 'id');

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest|Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->input());
        $post->updateTranslation('title', $request->get('title_ar'));
        $post->updateTranslation('body', $request->get('body_ar'));

        return redirect()->route('backend.admin.posts.index')
                         ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        ImageHelper::delete($post->image);
        $post->delete();

        return redirect()->route('backend.admin.posts.index')
                         ->with('success', 'Post deleted successfully.');
    }
}
