<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    function show(){
        return view("upload_form");
    }

    function upload(Request $request){
		$request->validate([
			'photo' => 'required|file|image|mimes:png,jpeg'
		]);
		$upload_image = $request->file('photo');
	
		if($upload_image) {
			//アップロードされた画像を保存する
			$path = $upload_image->store('uploads',"public");
			//画像の保存に成功したらDBに記録する
			if($path){
				Item::create([
					"file_name" => $upload_image->getClientOriginalName(),
					"file_path" => $path
				]);
			}
		}
		return redirect("/list");
    }
}