<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\CorporateType;
use Illuminate\Mail\Mailer;

class PagesController extends Controller
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @return mixed
     */
    public function partners()
    {
    	$corporateTypes = CorporateType::with('partners.details')->get();

    	return view('partners', compact('corporateTypes'));
    }

    /**
     * @return mixed
     */
    public function howItWorks()
    {
        return view('how-it-works');
    }

    /**
     * @return mixed
     */
    public function privacy()
    {
        return view('privacy');
    }

    /**
     * @return mixed
     */
    public function terms()
    {
        return view('tos');
    }
    
    public function tools()
    {
        return view('tools');
    }

    /**
     * @return mixed
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * @return mixed
     */
    public function about()
    {
        return view('about');
    }

    /**
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendInquiry(ContactRequest $request)
    {
        $input = $request->all();

        if(auth()->check()) {
            $user = auth()->user();
            $input['name'] = $user->name;
            $input['email'] = $user->email;
        }

        $toEmail = env('TO_EMAIL') ? env('TO_EMAIL') : 'info@qarenhom.com';
        $toName = env('TO_NAME') ? env('TO_NAME') : 'Qarenhom';

        $this->mailer->send('emails.applications.inquiry', [
            'name' => $input['name'],
            'email' => $input['email'],
            'inquiry' => $input['message'],
        ],
        function ($m) use ($toEmail, $toName) {
            $m->to($toEmail, $toName)->subject('New Inquiry');
        });

        return redirect()->back()->with('success', trans('main.inquirySent'));
    }
}
