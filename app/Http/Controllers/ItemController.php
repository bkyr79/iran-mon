<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Auth;

class ItemController extends Controller
{
    function show(){
        return view("upload_form");
    }

    function upload(Request $request){
		$request->validate([
			'file_path' => 'required|file|image|mimes:png,jpeg'
		]);
		$upload_image = $request->file('file_path');
	
		if($upload_image) {
			//アップロードされた画像を保存する
			$path = $upload_image->store('uploads',"public");
			$user_id = Auth::id(); //『Auth::id()』でログイン中のidを取得できる
            
            //画像の保存に成功したらDBに記録する
			if($path){
				Item::create([
                    //ログイン中ユーザーIDを取得
                    "user_id" => $user_id,
                    
					"file_name" => $upload_image->getClientOriginalName(),
					"file_path" => $path
				]);
			}
		}
		return redirect("/list");
    }
}