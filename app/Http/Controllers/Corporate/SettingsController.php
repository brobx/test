<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Requests;
use Illuminate\Http\Request;

class SettingsController extends CorporateController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        return view('corporate.pages.profile');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProfile(Request $request)
    {
        $required = $request->has('email') ? 'required' : '';

        $this->validate($request, [
            'name' => 'required',
            'email' => $required . '|email|unique:users,email,' . $this->signedUser->id,
            'password' => $required . '|min:6|confirmed'
        ]);
        
        $input = $request->all();

        if($request->has('password')) {
            $input['password'] = bcrypt($request->get('password'));
        }

        $this->signedUser->update($input);

        return redirect()->route('backend.corporate.settings.profile')
                         ->with('success', 'Profile updated successfully.');
    }
}
