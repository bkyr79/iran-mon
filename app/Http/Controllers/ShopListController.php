<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ShopList;
use Auth;
use Illuminate\Support\Facades\DB;

class ShopListController extends Controller
{
    function index(){
        $shop_owner_id = DB::table('users')->get();

        return view("shop_list", [
            "shop_owner_id" => $shop_owner_id,
        ]);    
    }
}
