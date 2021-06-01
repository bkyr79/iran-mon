<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録ページ</title>
    <link href="{{ asset('/css/upload_form.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

<!-- Bootstrap導入 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- Bootstrap Javascript(jQuery含む) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="login-state">{{ Auth::user()->name }}さんがログイン中</div>
<div class="uploadpage-title">{{ Auth::user()->name }}さんの商品登録ページ</div>
<div class="acc-menu">
<ul class="header-dropmenu">
  <li>
    <a href="#" class="menu-btn">メニュー</a>
    <ul>
      <li><a href="{{ url('/list') }}">マイページに戻る</a></li>
      <li><a href="{{ route('delete_list') }}">Delete</a></li>
      <li><a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">ログアウト</a></li>
    </ul>
  </li>
</ul>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<hr class="sepa-border"/>

<div class="uploadpage-content">
<form
  method="post"
  action="{{ route('upload_image') }}"
  enctype="multipart/form-data"
>
  @csrf
  <div class="file-select"><input type="file" name="file_path" accept="image/png, image/jpeg" onchange="previewImage(this);"></div>
  <div class="name-input"><label for="">商品名：</label><input type="text" name="goods_name" value="{{ old('goods_name') }}"></div>
  <div class="price-input"><label for="">価格：</label><input type="text" name="goods_price" value="{{ old('goods_price') }}"></div>
  <div class="label-and-regbtn"><p class="preview-title">Preview:</p><p><input type="submit" value="登録" class="file-register"></p></div>
</form>
<div class="pre-image">
<img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="preview-img">
</div>
</div>

<!-- プレビュー画像を表示させる -->
<script>
function previewImage(obj)
{
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
}
</script>

</body>
</html>