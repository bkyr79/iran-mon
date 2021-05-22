<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Request;
use App\Item;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Illuminate\Database\Eloquent\Model; 

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class ShopController extends Controller
{
    public function show(Request $request){
        // $shop_idは、shoplist画面で選択されたショップオーナーのid。
        $shop_id = $request->owner_id; 
        $uploads = Item::orderBy("id", "desc")->where('user_id', '=', $shop_id)->get();

        return view("shop", [
            "images" => $uploads,
            "owner_name" => $request->owner_name,
            "owner_id" => $request->owner_id,
        ]);
    }

    public function edit(Request $request) {  
        $item = new Item;
        $item->where('id', $request->id)->update(['user_id' => $request->buyer_id]);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy'
            ));

			// return redirect("/list");
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

        return redirect('/list');
    }
}
