<?php

namespace App\Http\Controllers;

use App\Billing\Payfort;
use App\Http\Requests;
use App\Lead;
use App\Listing;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Transaction;

class PaymentController extends Controller
{
    /**
     * @var Payfort
     */
    private $payfort;

    /**
     * @var User
     */
    private $user;

    /**
     * PaymentController constructor.
     * @param Payfort $payfort
     * @param Guard $guard
     */
    public function __construct(Payfort $payfort, Guard $guard)
    {
        $this->payfort = $payfort;
        $this->user = $guard->user();
    }

    /**
     * Shows the payement choice page.
     *
     * @param $listing
     * @return mixed
     */
    public function choice(Listing $listing)
    {
        return view('payment.choice', compact('listing'));
    }

    /**
     * Handles payment to agency.
     *
     * @param $listing
     * @return mixed
     */
    public function agency(Listing $listing)
    {
        $transaction = $this->user->charge($listing->getFieldValue('Price (Package)'), [
            'listing_id' => $listing->id,
            'status' => 2,
            'method' => 1
        ]);

        return redirect()->route('account.index')->with('success', trans('main.paymentSuccess'));
    }

    /**
     * @param Listing $listing
     * @return mixed
     */
    public function buy(Listing $listing)
    {
        try {
            $this->authorize($listing);
        }

        catch (AuthorizationException $ex) {
            return redirect()->route('account.index')
                             ->withErrors('This payment cannot be made to this listing');
        }

        $transaction = $this->user->charge($listing->getFieldValue('Price (Package)'), [
            'listing_id' => $listing->id,
            'status' => 0,
            'method' => 0
        ]);

        $parameters = $this->payfort->tokenize($transaction);

        return view('payment.index', compact('parameters', 'listing'));
    }

    /**
     * @param Request $request
     * @return bool
     * @internal param Listing $listing
     */
    public function callback(Request $request)
    {
        $transaction = preg_replace('/[0-9]+-t-/', '', $request->get('merchant_reference'));
        $transaction = Transaction::findOrFail($transaction);

        if($request->get('status') == 18) {
            $response = $this->payfort->charge(
                $transaction->amount,
                $request
            );

            // 3D-Secure check was requested.
            if(isset($response['3ds_url'])) {
                return redirect($response['3ds_url']);
            }

            $request->replace($response);
        }

        if($request->get('status') != 14) {
            return $this->handleError($transaction, $request);
        }

        return $this->handleSuccess($transaction, $request);
    }

    /**
     * Handles Errors.
     *
     * @param Transaction $transaction
     * @param Request $request
     * @return mixed
     */
    private function handleError(Transaction $transaction, Request $request)
    {
        $transaction->update([
            'status' => 1,
            'method' => 0
        ]);

        return view('payment.error')->with('error', $request->get('response_message'));
    }

    /**
     * Handles success.
     *
     * @param Transaction $transaction
     * @param Request $request
     * @return mixed
     */
    private function handleSuccess(Transaction $transaction, Request $request)
    {
        $transaction->update([
            'status' => 2,
            'method' => 2,
            'fort_id' => $request->get('fort_id')
        ]);

        return view('payment.success');
    }
}
