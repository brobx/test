<?php

namespace App\Http\Controllers\Corporate;

use App\CorporateBranch;
use App\Http\Requests;
use App\Http\Requests\BranchRequest;

class BranchesController extends CorporateController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = $this->corporate->branches()->paginate(20);

        return view('corporate.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('corporate.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BranchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        if($request->user()->is_corporate('manager')) {
            $branch = $this->corporate->branches()->create($request->all());
            $branch->addTranslation([
                'translatable_attribute' => 'name',
                'translation' => $request->get('name_ar')
            ]);

            $branch->addTranslation([
                'translatable_attribute' => 'address',
                'translation' => $request->get('address_ar')
            ]);

            return redirect()->route('backend.corporate.branches.index')
                             ->with('success', 'Branch created successfully');
        }

        $input = $request->all();
        $input['translations'] = [
            [
                'translatable_attribute' => 'name',
                'translation' => $request->get('name_ar')
            ],
            [
                'translatable_attribute' => 'address',
                'translation' => $request->get('address_ar')
            ]
        ];

        CorporateBranch::requestCreate($input);

        return redirect()->route('backend.corporate.branches.index')
                         ->with('success', 'Branch create request submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CorporateBranch $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(CorporateBranch $branch)
    {
        $branch->load('translations');

        return view('corporate.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BranchRequest $request
     * @param CorporateBranch $branch
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, CorporateBranch $branch)
    {
        if($request->user()->is_corporate('manager')) {
            $branch->update($request->all());
            $branch->updateTranslation('name', $request->get('name_ar'));
            $branch->updateTranslation('address', $request->get('address_ar'));

            return redirect()->route('backend.corporate.branches.index')
                             ->with('success', 'Branch updated successfully');
        }

        $input = $request->all();
        $input['translations'] = [
            [
                'translatable_attribute' => 'name',
                'translation' => $request->get('name_ar')
            ],
            [
                'translatable_attribute' => 'address',
                'translation' => $request->get('address_ar')
            ]
        ];

        $branch->requestUpdate($input);

        return redirect()->route('backend.corporate.branches.index')
                         ->with('success', 'Branch update request submitted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CorporateBranch $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(CorporateBranch $branch)
    {
        if(auth()->user()->is_corporate('manager')) {
            $branch->delete();

            return redirect()->route('backend.corporate.branches.index')
                             ->with('success', 'Branch deleted successfully');
        }

        $branch->requestDelete();

        return redirect()->route('backend.corporate.branches.index')
                         ->with('success', 'Branch delete request submitted successfully');
    }
}
