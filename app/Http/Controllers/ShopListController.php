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
        $users = DB::table('users');
        $userid_of_items = Item::distinct()->get('user_id')->implode('user_id', ', ');
        $userid_of_items = '[' . $userid_of_items . ']';
        // $id_of_users = User::get('id')->implode('id', ', ');

        // $hukumukadouka = in_array($userid_of_items[$i], $id_of_users, true);


        // $whether_has_items = $users->whereIn('id', $userid_of_items)->get();

dump($userid_of_items);
// echo $userid_of_items;
// dump($id_of_users);
die;

        return view("shop_list", [
            "shop_owner_id" => $shop_owner_id,
            "userid_of_items" => $userid_of_items,
            "whether_has_items" => $whether_has_items,
        ]);    
    }
}
