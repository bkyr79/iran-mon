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

        // チェックされた写真のidを配列に入れる
        $checked_ids[] = $request->del_checks;

        // \Log::debug(print_r($checked_ids, true));
        // dump($checked_ids);
        // dump($checked_ids[0]);
        // idは取れてるようです

        // そのidのデータを全て取得し、そのidの写真のfile_pathをS3から削除する
        $disk = Storage::disk('s3');
        for ($i=0; $i<count($checked_ids, COUNT_RECURSIVE)-1; $i++) {
            $items = Item::find($checked_ids[$i]);
            // \Log::debug(print_r($items[0]));
            // \Log::debug(print_r(count($checked_ids, COUNT_RECURSIVE)-1));
            // dump(count($checked_ids, COUNT_RECURSIVE)-1);
            dump($items[0]);
            $disk->delete($items[0]->file_path);
        }














        // $del_images = new Item;
        // $del_images->file_path = Item::where('id', '=', $request->del_checks);
        // $disk = Storage::disk('s3');
        // $disk->delete('/myprefix'.'/'.$del_images->file_path);
        // $disk->delete('/myprefix'.'/'.(string)$del_images->file_path);
        // これから試す↑

        // $disk->delete('/myprefix/BWpQ2ErhzEILTUCI4yPDpXDaOUqminrikAjztZfA.jpg');

        // for($i=0; $i<1; $i++){
        //     $images[] = $request->del_image[$i];
        // };
        // // $images = [$request->del_image[0], $request->del_image[1]];
        // foreach($images as $image){
        //     Storage::disk('s3')->delete($image);
        // };
        // return redirect('/list');
    }
}