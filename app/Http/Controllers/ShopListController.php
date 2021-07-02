<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\ShopList;
use Auth;
use Illuminate\Support\Facades\DB;

class ShopListController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    function index(){
        $userid_of_items = Item::distinct()->where('favorite', '=', 0)->get('user_id')->toArray();

                         // idがItemsテーブルのuser_idに含まれているユーザー情報(つまり、アイテムを所有しているユーザーの情報)
        $shop_owner_id = DB::table('users')->whereIn('id', $userid_of_items)->get();

        return view("shop_list", [
            "shop_owner_id" => $shop_owner_id,
        ]);    
    }
}
