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
        $shop_owner_id = DB::table('users')->get();

        // 変数定義(ショップリスト表示を、アイテム所有のショップのみするため)
        $userid_of_items = Item::get('user_id');
        $id_of_users = User::get('id');
        $userid_of_items = $userid_of_items->toArray();
        $id_of_users = $id_of_users->toArray();
        // $intersect = count(array_intersect($id_of_users, $userid_of_items));

dd($userid_of_items);

        // return view("shop_list", [
        //     "shop_owner_id" => $shop_owner_id,
        //     "userid_of_items" => $userid_of_items,
        //     "id_of_users" => $id_of_users,
        //     "intersect" => $intersect,

        // ]);    
    }
}
