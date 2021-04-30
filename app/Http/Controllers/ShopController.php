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

class ShopController extends Controller
{
    public function show(Request $request){
        // $shop_idは、shoplist画面で選択されたショップオーナーのid。
        $shop_id = $request->owner_id; 
        $uploads = Item::orderBy("id", "desc")->where('user_id', '=', $shop_id)->get();
        
        return view("shop", [
            "images" => $uploads,
            "owner_name" => $request->owner_name
        ]);
    }

    public function delete(Request $request)
    {
        $deleteItem = Item::find($request->id);

        // file_pathはItemテーブルのカラム名
        $deletepath = $deleteItem->file_path;

        // データベースのfile_path名は確認していたほうが確実(× 'public/uploads'. )
        Storage::delete('public/' . $deletepath);
        $deleteItem->delete();
        return redirect('/shop'); 
    }

}
