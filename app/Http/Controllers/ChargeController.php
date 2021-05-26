<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Item;

class ChargeController extends Controller
{
    /*単発決済用のコード*/
    public function charge(Request $request)
    {
        try {
            $goods_price = $request->price;

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                // ↓選択した商品価格に変更したい
                'amount' => $goods_price,
                'currency' => 'jpy'
            ));

			return redirect("/list");
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}