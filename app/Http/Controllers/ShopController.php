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

        // 選択した商品idからpriceを検索する。$price_dbはjson形式
        $goods_price_json = $item->where('id', '=', $request->id)->select('price')->get();

        // json形式から連想配列に変換する
        $goods_price_json_dec = json_decode($goods_price_json, true);

        // viewで使用できるようにキーを特定しておく
        $goods_price = $goods_price_json_dec[0]['price'];
        
        // $goods_priceをセッションに保存
        $request->session()->put('goods_price', $goods_price);
        // echo "<pre>";
        // // var_dump(array_column($goods_price, 'price'));
        // var_dump($price_db_deco[0]['price']);
        // echo "</pre>";
        // exit;

            return view("charge", [
                "goods_price" => $goods_price
            ]);

    }
}
