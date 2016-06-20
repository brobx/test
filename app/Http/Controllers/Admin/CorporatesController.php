<?php

namespace App\Http\Controllers\Admin;

use App\Corporate;
use App\CorporateType;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CorporateRequest;
use App\Service;
use Illuminate\Http\Request;

class CorporatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $corporates = Corporate::with('type');

        if ($request->has('type') && $request->get('type', '')) {
            $corporates->where('type_id', $request->get('type'));
        }

        $types = CorporateType::lists('title', 'id');
        $corporates = $corporates->paginate(20)->appends($request->except('page'));

        return view('admin.corporates.index', compact('corporates', 'types'));
    }

    /**
     * Show the form for creCorporateating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = CorporateType::lists('title', 'id');

        return view('admin.corporates.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CorporateRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CorporateRequest $request)
    {
        $corporate = Corporate::create($request->all());

        $corporate->addInitialUser([
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        $corporate->addTranslation([
            'translatable_attribute' => 'name',
            'translation' => $request->get('name_ar')
        ]);

        if ($corporate->type == 3) {
            $corporate->servicesWithCommission()->attach($corporate->type()->lists('id')->toArray());
        }

        return redirect()->route('backend.admin.corporates.index')
                         ->with('success', 'Corporate created successfully.');
    }

    /**
     * Toggles the suspension status of the corporate.
     * @param Corporate $corporate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspend(Corporate $corporate)
    {
        $action = $corporate->toggleSuspension() ? 'suspended' : 'restored';

        return redirect()->route('backend.admin.corporates.index')
                         ->with('success', "Corporate $action successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Corporate $corporate
     * @return \Illuminate\Http\Response
     */
    public function edit(Corporate $corporate)
    {
        $types = CorporateType::lists('title', 'id');

        return view('admin.corporates.edit', compact('types', 'corporate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CorporateRequest $request
     * @param Corporate $corporate
     * @return \Illuminate\Http\Response
     */
    public function update(CorporateRequest $request, Corporate $corporate)
    {
        $corporate->update($request->all());
        $corporate->updateTranslation('name', $request->get('name_ar'));

        return redirect()->route('backend.admin.corporates.index')
                         ->with('success', 'Corporate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Corporate $corporate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corporate $corporate)
    {
        $corporate->delete();

        return redirect()->route('backend.admin.corporates.index')
                         ->with('success', 'Deleted corporate successfully.');
    }

    /**
     * @param Request $request
     * @param Corporate $corporate
     * @return mixed
     */
    public function updateDiscount(Request $request, Corporate $corporate)
    {
        if ($corporate->type_id === 3) {
            return redirect()->back()->withErros('Cannot update discount of this corporate.');
        }

        $corporate->discount = $request->get('discount', 0);
        $corporate->lead_price = $request->get('lead_price', 0);
        $corporate->save();

        return redirect()->back()
                         ->with('success', "Updated {$corporate->name} discount successfully.");
    }

    /**
     * @param Request $request
     * @param Corporate $corporate
     * @param Service $service
     * @return mixed
     */
    public function updateCommission(Request $request, Corporate $corporate, Service $service)
    {
        $this->validate($request, [
            'commission' => 'numeric|min:0|max:100'
        ]);

        if ($corporate->type_id != 3) {
            return redirect()->back()->withErros('Cannot update commission of this corporate.');
        }

        $corporate->servicesWithCommission()->find($service->id)->pivot->update(['commission' => $request->get('commission', 0)]);
        $corporate->save();

        return redirect()->back()
                         ->with('success', "Updated {$corporate->name} commission successfully.");
    }
}
