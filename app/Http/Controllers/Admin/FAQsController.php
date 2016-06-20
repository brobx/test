<?php

namespace App\Http\Controllers\Admin;

use App\FAQ;
use App\FAQCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\FaqRequest;
use Illuminate\Http\Request;

class FAQsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::with('category')->paginate(20);

        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = FAQCategory::lists('title', 'id');

        return view('admin.faqs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FaqRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $faq = FAQ::create($request->all());
        $faq->addTranslation([
            'translatable_attribute' => 'question',
            'translation' => $request->get('question_ar')
        ]);

        $faq->addTranslation([
            'translatable_attribute' => 'answer',
            'translation' => $request->get('answer_ar')
        ]);

        return redirect()->route('backend.admin.faqs.index')
                         ->with('FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FAQ $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(FAQ $faq)
    {
        $categories = FAQCategory::lists('title', 'id');

        return view('admin.faqs.edit', compact('categories', 'faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FaqRequest|Request $request
     * @param FAQ $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, FAQ $faq)
    {
        $faq->update($request->all());

        $faq->updateTranslation('question', $request->get('question_ar'));
        $faq->updateTranslation('answer', $request->get('answer_ar'));

        return redirect()->route('backend.admin.faqs.index')
                         ->with('FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FAQ $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return redirect()->route('backend.admin.faqs.index')
                         ->with('FAQ deleted successfully.');
    }
}
