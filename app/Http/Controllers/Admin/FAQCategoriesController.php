<?php

namespace App\Http\Controllers\Admin;

use App\FAQCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FAQCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = FAQCategory::paginate(20);
        
        return view('admin.faqCategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|min:3', 'title_ar' => 'required|min:3']);
        
        $category = FAQCategory::create($request->all());
        $category->addTranslation([
            'translatable_attribute' => 'title',
            'translation' => $request->get('title_ar')
        ]);
        
        
        return redirect()->route('backend.admin.faq-categories.index')
                         ->with('FAQ category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FAQCategory $category
     * @return \Illuminate\Http\Response
     */
    public function edit(FAQCategory $category)
    {
        return view('admin.faqCategories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param FAQCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FAQCategory $category)
    {
        $category->update($request->all());
        $category->updateTranslation('title', $request->get('title_ar'));

        return redirect()->route('backend.admin.faq-categories.index')
                         ->with('FAQ category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FAQCategory $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(FAQCategory $category)
    {
        $category->delete();

        return redirect()->route('backend.admin.faq-categories.index')
                         ->with('FAQ category deleted successfully.');
    }
}
