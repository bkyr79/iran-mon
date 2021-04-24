<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Auth;

class ShopController extends Controller
{
    function show(){
        $uploads = Item::orderBy("id", "desc")->where('user_id', '=', Auth::id())->get();

        return view("shop", [
            "images" => $uploads
        ]);
    }
}
