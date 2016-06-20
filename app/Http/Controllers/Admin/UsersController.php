<?php

namespace App\Http\Controllers\Admin;

use App\Corporate;
use App\CorporateRole;
use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $corporates = Corporate::lists('name', 'id');
        $corporateRoles = CorporateRole::lists('title', 'id');
        $roles = Role::lists('title', 'id');

        $users = User::with('role', 'corporate', 'corporateRole');
        $this->filterRequest($request, $users);

        $users = $users->paginate(20)->appends($request->except('page'));

        return view('admin.users.index', compact('users', 'corporates', 'corporateRoles', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $corporates = Corporate::lists('name', 'id');
        $corporateRoles = CorporateRole::lists('title', 'id');
        $roles = Role::lists('title', 'id');

        return view('admin.users.create', compact('corporates', 'corporateRoles', 'roles'));
    }

    /**
     * Store a newly created resource in storage  *
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create($this->getAttributes($request));

        return redirect()->route('backend.admin.users.index')
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
        $corporates = Corporate::lists('name', 'id');
        $corporateRoles = CorporateRole::lists('title', 'id');
        $roles = Role::lists('title', 'id');

        return view('admin.users.edit', compact('user', 'corporates', 'corporateRoles', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($this->getAttributes($request));

        return redirect()->route('backend.admin.users.index')
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

        return redirect()->route('backend.admin.users.index')
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

        return redirect()->route('backend.admin.users.index')
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
        
        if($request->has('password')) {
            $input['password'] = bcrypt($request->get('password'));
        }

        return $input;
    }

    private function filterRequest(Request $request, $users)
    {
        if($request->has('role') && $request->get('role')) {
            $users->where('role_id', $request->get('role'));
        }

        if($request->has('corporate') && $request->get('corporate')) {
            $users->where('corporate_id', $request->get('corporate'));
        }

        if($request->has('corporate_role') && $request->get('corporate_role')) {
            $users->where('corporate_role_id', $request->get('corporate_role'));
        }
    }
}
