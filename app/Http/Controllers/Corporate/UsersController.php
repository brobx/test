<?php

namespace App\Http\Controllers\Corporate;

use App\Corporate;
use App\CorporateRole;
use App\Http\Requests\CorpUserRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends CorporateController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Respons  */
    public function index(Request $request)
    {
        $corporateRoles = CorporateRole::lists('title', 'id');

        $users = $this->corporate->users();
        $this->filterRequest($request, $users);

        $users = $users->paginate(20)->appends($request->except('page'));

        return view('corporate.users.index', compact('users', 'corporates', 'corporateRoles', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $corporateRoles = CorporateRole::lists('title', 'id');

        return view('corporate.users.create', compact('corporateRoles'));
    }

    /**
     * Store a newly created resource in storage  *
     * @param CorpUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CorpUserRequest $request)
    {
        $this->corporate->users()->create($this->getAttributes($request));

        return redirect()->route('backend.corporate.users.index')
                         ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $corporateRoles = CorporateRole::lists('title', 'id');

        return view('corporate.users.edit', compact('user', 'corporateRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CorpUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(CorpUserRequest $request, User $user)
    {
        $user->update($this->getAttributes($request));

        return redirect()->route('backend.corporate.users.index')
                         ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('backend.corporate.users.index')
                         ->with('success', 'User deleted successfully.');
    }

    /**
     * Toggles user suspension status.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspend(User $user)
    {
        $user->suspended = ! $user->suspended;
        $user->save();
        $action = $user->suspended ? 'suspended' : 'restored';

        return redirect()->route('backend.corporate.users.index')
                         ->with('success', "User $action successfully.");
    }

    /**
     * Gets the user attributes from request, processes the input.
     *
     * @param Request $request
     * @return array
     */
    protected function getAttributes(Request $request)
    {
        $input = $request->all();
        $input['role_id'] = 2;

        if($request->has('password')) {
            $input['password'] = bcrypt($request->get('password'));
        }

        return $input;
    }

    /**
     * @param Request $request
     * @param $users
     */
    private function filterRequest(Request $request, $users)
    {
        if($request->has('corporate_role') && $request->get('corporate_role')) {
            $users->where('corporate_role_id', $request->get('corporate_role'));
        }
    }
}
