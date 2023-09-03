<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Models\Product;

class PaymentController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }

    public function index($id)
    {
        $product = Product::findOrFail($id);

        // return view('product/view', compact('product', $product));
        return view('payment', compact('product', $product));
    }
    public function success()
    {
        return view('success');
    }

    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required|Max:16',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required|Max:3'
        ]);

        if ($validator->fails()) {
            $request->session()->flash('danger', $validator->errors()->first());
            // return response()->redirectTo('/buy-now');
            return redirect()->back();
        }
        // print_r($request->input());die;

        $token = $this->createToken($request);
        if (!empty($token['error'])) {
            $request->session()->flash('danger', $token['error']);
            return redirect()->back();
        }
        if (empty($token['id'])) {
            $request->session()->flash('danger', 'Payment failed.');
            return redirect()->back();
        }
        $amount = $request['amount'];
        $charge = $this->createCharge($token['id'], $request['amount']);
        if (!empty($charge) && $charge['status'] == 'succeeded') {
            $request->session()->flash('success', 'Transaction of Amount : $'.$amount.' is paid Successfully.');
            return response()->redirectTo('success');
        } else {
            $request->session()->flash('danger', 'Payment failed.');
            return redirect()->back();
        }
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
}
