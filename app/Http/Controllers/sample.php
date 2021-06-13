<?

// public function create(Request $request)
//   {
//       $item = new Item;
//       $form = $request->all();

//       //s3アップロード開始
//       $upload_image = $request->file('file_path');
//       // バケットの`myprefix`フォルダへアップロード
//       $path = Storage::disk('s3')->putFile('myprefix', $upload_image, 'public');
//       // アップロードした画像のフルパスを取得
//       $item->image_path = Storage::disk('s3')->url($path);

//       $item->save();

//       return redirect('posts/create');
//   }