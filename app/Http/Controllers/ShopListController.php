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

        $userid_of_items = Item::get('user_id');
        $id_of_users = User::get('id');
        // $userid_of_items = $userid_of_items->toArray();
        // $id_of_users = $id_of_users->toArray();

        dump($userid_of_items);
        dump($id_of_users);

        // return view("shop_list", [
        //     "shop_owner_id" => $shop_owner_id,
        //     "userid_of_items" => $userid_of_items,
        //     "id_of_users" => $id_of_users,
        // ]);    
    }
}
