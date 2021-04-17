<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemListController extends Controller
{
    function show(){
        $uploads = Item::orderBy("updated_at", "desc")->get();

        return view("item_list", [
            "images" => $uploads
        ]);
    }
}
