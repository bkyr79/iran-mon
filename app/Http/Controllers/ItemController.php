<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	function show(){
			return view("upload_form");
	}

	function upload(Request $request){
		$request->validate([
			'file_path' => 'required|file|image|mimes:png,jpeg',
			// 'file_name' => ['file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000']
			'file_name' => ['file', 'image', 'mimes:jpeg,png,jpg,gif'],
			'goods_name' => ['required', 'string'],
			'goods_price' => ['required', 'integer', 'min:1', 'max:1000'],
		],
		[
			'file_path.required' => '商品写真は必須です。',
			'goods_name.required' => '商品名は必須です。',
			'goods_name.string' => '商品名が正しくありません。',
			'goods_price.required'  => '価格は必須です。',
			'goods_price.integer'  => '価格は数字で入力してください。',
			'goods_price.min'  => '価格は1円以上で入力してください。',
			'goods_price.max'  => '価格は1000円以下で入力してください。',
		]);





		$upload_image = $request->file('file_path');
	
		if($upload_image) {
			//アップロードされた画像を保存する(ローカル用の記述)
			// $path = $upload_image->store('uploads',"public");


			//アップロードされた画像をS3へ保存する(本番用の記述)
      $item = new Item;
      $form = $request->all();

      //s3アップロード開始
      // バケットの`myprefix`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('myprefix', $upload_image, 'public');
      // アップロードした画像のフルパスを取得
      $item->image_path = Storage::disk('s3')->url($path);
      $item->save();



			$user_id = Auth::id(); //『Auth::id()』でログイン中のidを取得できる
			$goods_name = $request->input('goods_name');
			$goods_price = $request->input('goods_price');

		// 	//画像の保存に成功したらDBに記録する
			// if($path){
			// 	Item::create([
			// 		//ログイン中ユーザーIDを取得
			// 		"user_id" => $user_id,
			// 		"name" => $goods_name,
			// 		"price" => $goods_price,
			// 		"file_name" => $upload_image->getClientOriginalName(),
			// 		"file_path" => $path,
			// 		// 'file_name' => $fileNameToStore
			// 	]);
			// }
		}

		//引数 $data から name='file_name'を取得(アップロードするファイル情報)
		$imageFile = $request->file_path;

		//$imageFileからファイル名を取得(拡張子あり)
		$filenameWithExt = $imageFile->getClientOriginalName();

		//拡張子を除いたファイル名を取得
		$fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);

		//拡張子を取得
		$extension = $imageFile->getClientOriginalExtension();

		// ファイル名_時間_拡張子 として設定
		// $fileNameToStore = $fileName.'_'.time().'.'.$extension;

		//画像ファイル取得
		$fileData = file_get_contents($imageFile->getRealPath());

		//拡張子ごとに base64エンコード実施
		if ($extension = 'jpg'){
		$data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
		}

		if ($extension = 'jpeg'){
		$data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
		}

		if ($extension = 'png'){
		$data_url = 'data:image/png;base64,'. base64_encode($fileData);
		}

		if ($extension = 'gif'){
		$data_url = 'data:image/gif;base64,'. base64_encode($fileData);
		}

		//画像アップロード(Imageクラス makeメソッドを使用)
		$image = Image::make($data_url);

		//画像を横400px, 縦400pxにリサイズし保存
		// $image->resize(150,150)->save(storage_path() . '/app/public/uploads/' . $fileNameToStore );
		$image->resize(150,150)->save(storage_path() . '/app/public/uploads/' . $upload_image->getClientOriginalName() );


		return redirect("/list");			
	}
}