<?php

namespace App\Billing;

use App\Transaction;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class Payfort
{
    /**
     * @var User
     */
    private $user = null;

    /**
     * Payfort constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->user = $guard->user();
    }

    /**
     * @param Transaction $transaction
     * @return array
     */
    public function tokenize(Transaction $transaction)
    {
        $params = [
            'access_code' => config('services.payfort.access_code'),
            'merchant_reference' => time() . '-t-' . $transaction->id,
            'language' => config('app.locale'),
            'merchant_identifier' => config('services.payfort.id'),
            'service_command' => 'TOKENIZATION',
            'return_url' => route('listing.buy.charge')
        ];

        $params['signature'] = $this->generateSignature($params);

        return $params;
    }

    /**
     * Charges the customer with the specified amount.
     *
     * @param $amount
     * @param Request $request
     * @return mixed
     */
    public function charge($amount, Request $request)
    {
        $params = [
            'access_code' => config('services.payfort.access_code'),
            'amount' => $amount,
            'currency' => 'EGP',
            'customer_email' => $this->user->email,
            'merchant_reference' => $request->get('merchant_reference'),
            'token_name' => $request->get('token_name'),
            'language' => config('app.locale'),
            'merchant_identifier' => config('services.payfort.id'),
            'command' => 'PURCHASE',
            'return_url' => route('listing.buy.charge')
        ];

        $params['signature'] = $this->generateSignature($params);
        $client = new Client();
        $response = $client->post(config('services.payfort.url'), ['json' => $params]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param array $params
     * @return string
     */
    public function generateSignature($params = [])
    {
        $pass = config('services.payfort.request_phrase');

        ksort($params);
        $signature = $pass;

        foreach ($params as $key => $value) {
            $signature .= "{$key}={$value}";
        }

        $signature .= $pass;

        return hash('sha256', $signature);
    }
}
