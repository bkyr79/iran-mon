<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Request;
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
        ]);
    }

    public function edit(Request $request) {  
        $post = Item::find(1);
        if(is_null($_POST)) {
            return redirect('/list');
        }

        $post = Item::find($request->id);

        $post->user_id = $request->buyer_id;
        $post->save();
        return redirect('/list');
    }
}
