<?php

namespace App\Traits;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

trait PaypalPayment
{

    use Settings;

    private $settings;

    public function setupPaypalConfig() {
        $this->settings = $this->getSettings(['paypal_mode', 'paypal_client_id', 'paypal_secret_id', 'paypal_app_id']);

        $paypalConfig = [
                'mode'    => $this->settings['paypal_mode']['value'],
                'sandbox' => [
                    'client_id'         => $this->settings['paypal_mode']['value'] == 'sandbox' ? $this->settings['paypal_client_id']['value'] : '',
                    'client_secret'     => $this->settings['paypal_mode']['value'] == 'sandbox' ? $this->settings['paypal_secret_id']['value'] : '',
                    'app_id'            => $this->settings['paypal_mode']['value'] == 'sandbox' ? $this->settings['paypal_app_id']['value'] : '',
                ],
                'live' => [
                    'client_id'         => $this->settings['paypal_mode']['value'] == 'live' ? $this->settings['paypal_client_id']['value'] : '',
                    'client_secret'     => $this->settings['paypal_mode']['value'] == 'live' ? $this->settings['paypal_secret_id']['value'] : '',
                    'app_id'            => $this->settings['paypal_mode']['value'] == 'live' ? $this->settings['paypal_app_id']['value'] : '',
                ],
            ] + config('paypal');

        config(['paypal' => $paypalConfig]);

    }

    public function makePaypalPayment($amount = 0) {

        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $paypalToken = $paypal->getAccessToken();

        $response = $paypal->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => env('PAYPAL_VALIDATION_LINK'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $amount
                    ]
                ]
            ]
        ]);

        return $response;

    }

    public function validatePaypalPayments($token) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($token);


        return $response;

    }

}
