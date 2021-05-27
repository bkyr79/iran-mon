<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Illuminate\Database\Eloquent\Model; 

class ShopController extends Controller
{
    public function show(Request $request){
        // $shop_idは、shoplist画面で選択されたショップオーナーのid。
        $shop_id = $request->owner_id; 
        $uploads = Item::orderBy("id", "desc")->where('user_id', '=', $shop_id)->paginate(12);

        return view("shop", [
            "images" => $uploads,
            "owner_name" => $request->owner_name,
            "owner_id" => $request->owner_id,
        ]);
    }

    // formから値を受け取りセッション保存。
    public function receiveInfoGoodsToBuy(Request $request) {  

        $item = new Item;

        // 選択した商品idからpriceを検索する。$price_dbはjson形式
        $goods_price_json = $item->where('id', '=', $request->id)->select('price')->get();

        // json形式から連想配列に変換する
        $goods_price_json_dec = json_decode($goods_price_json, true);

        // viewで使用できるようにキーを特定しておく
        $goods_price = $goods_price_json_dec[0]['price'];
        
        // クリックした商品のid
        $id_of_item_to_buy = $request->id;

        $buyer_id = $request->buyer_id;

        // $id_of_item_to_buyと$buyer_idをセッションに保存(決済処理のタイミングで必要なため)
        $request->session()->put('id_of_item_to_buy', $id_of_item_to_buy);
        $request->session()->put('buyer_id', $buyer_id);
        // $goods_priceをセッションに保存
        $request->session()->put('goods_price', $goods_price);

            return view("charge", [
                "goods_price" => $goods_price
            ]);

    }
}
