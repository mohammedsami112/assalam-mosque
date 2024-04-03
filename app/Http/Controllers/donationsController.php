<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationType;
use App\Models\Scopes\DonationsScope;
use App\Traits\PaypalPayment;
use App\Traits\StripePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class donationsController extends Controller {

    use StripePayment, PaypalPayment;

    public function __construct() {

        $this->setupStripeConfig();
        $this->setupPaypalConfig();

    }

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

            $stripeLink = $this->makeStripePayment($request->amount, $type->title);

            Donation::create([
                'name' => $request->name,
                'email' => $request->email,
                'amount' => $request->amount,
                'method' => 'Card',
                'show_name' => $request->show_name,
                'type' => $request->type,
                'session_id' => $stripeLink['id'],
            ]);

            return $stripeLink['url'];
        }

        if ($request->method == 'paypal') {

            $paypalLink = $this->makePaypalPayment($request->amount);

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

        $response = $this->validateStripePayments($request->session_id);

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

        $response = $this->validatePaypalPayments($request['token']);
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
