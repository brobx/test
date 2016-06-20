<?php

namespace App\Http\Controllers;

use App\CorporateType;
use App\Http\Requests;
use App\Lead;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(Guard $guard)
    {
        $this->user = $guard->user();
        $this->user->load('interests');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $user = $this->user;
        $user->load('leads.listing.corporate.translations', 'leads.listing.translations', 'leads.review');
        $corporateTypes = CorporateType::with('services')->get();
        $this->injectRateability($user->leads);
        $settings = $this->user->settings();

        return view('account', compact('user', 'corporateTypes', 'settings'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateProfile(Request $request)
    {
        $this->user->update($request->except(['password']));

        return redirect()->route('account.index')
                         ->with('success', trans('main.infoChanged'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateInterests(Request $request)
    {
        $this->user->interests()
                   ->sync($request->get('services'));

        return redirect()->route('account.index')
                         ->with('success', trans('main.infoChanged'));
    }

    /**
     * @param Lead $lead
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function cancelLead(Lead $lead)
    {
        try {
            $this->authorize('cancel', $lead);
        }

        catch (\Exception $ex) {
            return redirect()->back()->withErrors(trans('main.infoChanged'));
        }

        $lead->canceled = true;
        $lead->save();

        return redirect()->route('listing.apply', $lead->listing->id)
                         ->with('success', trans('main.infoChanged'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updatePreferences(Request $request)
    {
        $this->user->settings()->sync($request->all());

        return redirect()->route('account.index')
                         ->with('success', trans('main.infoChanged'));
    }

    /**
     * @param $leads
     */
    private function injectRateability($leads)
    {
        foreach ($leads as $lead) {
            try {
                $this->authorize('rate', $lead->listing);
                $lead->canRate = true;
            } catch (\Exception $ex) {
                $lead->canRate = false;
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function security()
    {
        return view('changePassword');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|old_password',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('account.index')->with('success', trans('main.passwordChanged'));
    }
}
