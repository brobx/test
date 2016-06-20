<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TopicRequest;
use App\Service;
use App\Topic;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function index(Service $service)
    {
        $topics = $service->topics()->orderBy('priority', 'asc')->paginate(25);
        
        return view('admin.learn.topics.index', compact('service', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function create(Service $service)
    {
        return view('admin.learn.topics.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TopicRequest|Request $request
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request, Service $service)
    {
        $topic = $service->topics()->create($request->input());
        $topic->createTranslation('title', $request->get('title_ar'));
        $topic->createTranslation('body', $request->get('body_ar'));
        
        return redirect()->route('backend.admin.learn.topics.index', $service->id)
                         ->with('success', 'Topic created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service, Topic $topic)
    {
        return view('admin.learn.topics.edit', compact('service', 'topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TopicRequest|Request $request
     * @param Service $service
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, Service $service, Topic $topic)
    {
        $topic->update($request->input());
        $topic->updateTranslation('title', $request->get('title_ar'));
        $topic->updateTranslation('body', $request->get('body_ar'));

        return redirect()->route('backend.admin.learn.topics.index', $service->id)
                         ->with('success', 'Topic updated successfully.'); 
    }

    /**
     * Remove the specified resource from storage.
     * @param Service $service
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Service $service, Topic $topic)
    {
        $topic->delete();
        
        return redirect()->route('backend.admin.learn.topics.index', $service->id)
                         ->with('success', 'Topic deleted successfully.'); 
    }
}
