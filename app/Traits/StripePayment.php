<?php

namespace App\Traits;

use Stripe\StripeClient;

trait StripePayment
{

    use Settings;

    private $settings;

    public function setupStripeConfig() {
        $this->settings = $this->getSettings(['stripe_secret_key']);
    }

    public function makeStripePayment($amount = 0, $title = null) {

        $stripe = new StripeClient($this->settings['stripe_secret_key']['value']);

        $paymentLink = $stripe->checkout->sessions->create([
            'success_url' => env('STRIPE_VALIDATION_LINK') . '?session_id={CHECKOUT_SESSION_ID}',
            'payment_method_types' => ['link', 'card'],
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $title
                        ],
                        'unit_amount' => 100 * $amount,
                        'currency' => 'EUR'
                    ],
                    'quantity' => 1
                ]
            ],
            'mode' => 'payment',
            'allow_promotion_codes' => false
        ]);

        return $paymentLink;

    }

    public function validateStripePayments($session_id) {
        $stripe = new StripeClient($this->settings['stripe_secret_key']['value']);

        $response = $stripe->checkout->sessions->retrieve($session_id);



        return $response;

    }

}
