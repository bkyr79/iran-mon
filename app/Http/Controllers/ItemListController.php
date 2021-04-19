<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Auth;

class ItemListController extends Controller
{
    function show(){
        //where句で条件指定することで、ログインユーザーの商品のみを表示させる
        $uploads = Item::orderBy("id", "desc")->where('user_id', '=', Auth::id())->get();

        return view("item_list", [
            "images" => $uploads
        ]);
    }
}
