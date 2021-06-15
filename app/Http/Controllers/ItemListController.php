<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Auth;
use App\Post;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Session\SessionManager;

class ItemListController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    function show(){
        //where句で条件指定することで、ログインユーザーの商品のみを表示させる
        $uploads = Item::orderByRaw("updated_at desc, created_at desc, id desc")->where('user_id', '=', Auth::id())->paginate(12);
        $data_count = Item::where('user_id', '=', Auth::id())->count();

        return view("item_list", [
            "images" => $uploads,
            "data_count" => $data_count,
        ]);
    }

    // 商品名変更メソッド
    public function edit(Request $request) {
        $post = Item::find(1);
        $post = Item::find($request->id);
        $post->name = $request->goods_name;

        if(is_null($_POST)) {
            return redirect('/list');
        }
        
        if(empty($request->goods_name)){
            return redirect("/list");
        }

        $post->save();

        return redirect('/list');
    }   

    function deleteList(){
        $images = Item::orderByRaw("updated_at desc, created_at desc, id desc")->where('user_id', '=', Auth::id())->paginate(12);
        return view("delete_list", ['images' => $images]);
    }

    public function delete(Request $request){
        
        Item::destroy($request->del_checks);

        $del_images = new Item;
        $del_images->file_path = Item::where('id', '=', $request->del_checks);
        $disk = Storage::disk('s3');
        $disk->delete('/myprefix'.'/'.$del_images->file_path);


        // $disk->delete('/myprefix/BWpQ2ErhzEILTUCI4yPDpXDaOUqminrikAjztZfA.jpg');

        return redirect('/list');
    }
}