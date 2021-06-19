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

// print_r($userid_of_items);
print_r(str_replace('Array', '', $$userid_of_items));

// $str = 'abcde';
// $str = str_replace('Array', '', $$userid_of_items);
// echo $str; // -> cde




        // return view("shop_list", [
        //     "shop_owner_id" => $shop_owner_id,
        //     "userid_of_items" => $userid_of_items,
        //     "id_of_users" => $id_of_users,
        //     "intersect" => $intersect,

        // ]);    
    }
}
