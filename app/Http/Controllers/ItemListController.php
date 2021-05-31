<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Auth;
use App\Post;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Storage;

class ItemListController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    function show(){
        //where句で条件指定することで、ログインユーザーの商品のみを表示させる
        $uploads = Item::orderBy("updated_at", "desc")->where('user_id', '=', Auth::id())->paginate(12);

        return view("item_list", [
            "images" => $uploads,
        ]);
    }

    // 商品名変更メソッド
    public function edit(Request $request) {
        $post = Item::find(1);
        if(is_null($_POST)) {
            return redirect('/list');
        }

        $post = Item::find($request->id);

        $post->name = $request->goods_name;
        $post->save();
        return redirect('/list');
    }   

    function deleteList(){
        $images = Item::orderBy("updated_at", "desc")->where('user_id', '=', Auth::id())->paginate(12);
        return view("delete_list", ['images' => $images]);
    }

    public function delete(Request $request){
        Item::destroy($request->del_checks);
        return redirect('/list');
    }
}
