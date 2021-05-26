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
    public function chargeAndChangeOwnership(Request $request)
    {
        try {
            $id_of_item_to_buy = $request->session()->get('id_of_item_to_buy');
            $goods_price = $request->session()->get('goods_price');
            $buyer_id = $request->session()->get('buyer_id');

            // user_idを更新する 
            $item = new Item;
            $item->where('id', $id_of_item_to_buy)->update(['user_id' => $buyer_id]);

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $goods_price,
                'currency' => 'jpy'
            ));

			return redirect("/list");
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}