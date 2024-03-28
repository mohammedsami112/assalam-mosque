<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationType;
use App\Models\Scopes\DonationsScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\StripeClient;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class donationsController extends Controller {

    public function getDonations() {
        $donations = Donation::without('donationType')->select(['id', 'name', 'amount', 'show_name'])->orderBy('created_at', 'desc')->take(10)->get();

        $donations->each(function($donation) {
            $donation->name = $donation->show_name == 1 ? $donation->name : 'فاعل خير';
        });

        return $this->success($donations);
    }

    public function getDonationsTypes() {
        $donationTypes = DonationType::select(['id', 'title'])->orderBy('id', 'desc')->get();

        return $this->success($donationTypes);

    }

    public function makeDonation(Request $request) {
        $validation = Validator::make($request->all(), [
            'amount' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'type' => 'required|exists:donation_types,id'
        ]);

        if ($validation->fails()) {
            return $this->error('Validation Error', $validation->errors());
        }

        $type = DonationType::find($request->type);

        if ($request->method == 'visa-mastercard') {
            $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

            $paymentLink = $stripe->checkout->sessions->create([
                'success_url' => env('STRIPE_VALIDATION_LINK') . '?session_id={CHECKOUT_SESSION_ID}',
                'payment_method_types' => ['link', 'card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'product_data' => [
                                'name' => $type->title
                            ],
                            'unit_amount' => 100 * $request->amount,
                            'currency' => 'EUR'
                        ],
                        'quantity' => 1
                    ]
                ],
                'mode' => 'payment',
                'allow_promotion_codes' => false
            ]);

            Donation::create([
                'name' => $request->name,
                'email' => $request->email,
                'amount' => $request->amount,
                'method' => 'Card',
                'show_name' => $request->show_name,
                'type' => $request->type,
                'session_id' => $paymentLink['id'],
            ]);

            return $paymentLink['url'];
        }

        if ($request->method == 'paypal') {
            $paypal = new PayPalClient;
            $paypal->setApiCredentials(config('paypal'));
            $paypalToken = $paypal->getAccessToken();

            $paypalLink = $paypal->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => env('PAYPAL_VALIDATION_LINK'),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "EUR",
                            "value" => $request->amount
                        ]
                    ]
                ]
            ]);

            Donation::create([
                'name' => $request->name,
                'email' => $request->email,
                'amount' => $request->amount,
                'method' => 'Paypal',
                'show_name' => $request->show_name,
                'type' => $request->type,
                'session_id' => $paypalLink['id'],
            ]);

            foreach ($paypalLink['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return $links['href'];
                }
            }

        }

    }

    public function validateStripePayment(Request $request) {

        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        $paymentStatus = $response['payment_status'] == 'paid' ? 'success' : 'fail';


        if (isset($request->session_id) || $paymentStatus == 'success') {

            $donation = Donation::withoutGlobalScope(DonationsScope::class)->where('session_id', '=', $request->session_id)->first();

            $donation->update([
                'status' => 1
            ]);

        }

        return redirect(env('PAYMENT_RETURN_URL') . '?payment_status=' . $paymentStatus);


    }

    public function validatePaypalPayment(Request $request) {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        $paymentStatus = $response['status'] == 'COMPLETED' ? 'success' : 'fail';


        if (isset($request->token) || $paymentStatus == 'success') {

            $donation = Donation::withoutGlobalScope(DonationsScope::class)->where('session_id', '=', $request->token)->first();

            $donation->update([
                'status' => 1
            ]);

        }
        return redirect(env('PAYMENT_RETURN_URL') . '?payment_status=' . $paymentStatus);

    }

}
