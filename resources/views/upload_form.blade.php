<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    ul.header-dropmenu {
    list-style: none;
    width: 100%;
    height: 40px;
    margin: 0 auto;
    padding: 0;
    display: block;
    table-layout: fixed;
    }
    ul.header-dropmenu > li {
    position: relative;
    /* display: table-cell; */
    vertical-align: middle;
    border: 1px solid #f8f8f8;
    background: #f8f8f8; /* 背景色*/
    }
    ul.header-dropmenu li a {
    display: block;
    text-align: center;
    line-height: 40px;
    font-weight: bold;
    text-decoration: none;
    font-size: 14px;
    }
    ul.header-dropmenu li ul {
    visibility: hidden;
    width: 100%;
    list-style: none;
    position: absolute;
    top: 100%;
    left: -1px;
    margin: 0;
    padding: 0;
    border: 1px solid #222; /* マウスオーバー時の枠線 */
    border-top: none;
    border-right: none;
    }
    ul.header-dropmenu li:hover ul {
    visibility: visible;
    }
    ul.header-dropmenu li ul li {
    background: #fff;
    transition: all .2s ease;
    }
    ul.header-dropmenu > li:hover {
    background: #fff;
    border: 1px solid #222; /* マウスオーバー時の枠線 */
    border-bottom: none;
    border-right: none;
    }
    ul.header-dropmenu li:hover ul li:hover {
    background: #f8f8f8;
    }
    .menu-btn:hover {
    cursor: default;
    }
    .file-select {
      margin: 9px 0px;
    }
    .name-input {
      position: relative;
      right: 8px;
      margin-bottom: 5px;    
    }  
    .price-input {
      margin-top: 0px;
    }
    .register-submit {
      position: relative;
      left: 100px;
      margin-top: 8px;
    }
    .file-register {
    display       : inline-block;
    border-radius : 3%;
    font-size     : 14pt;
    text-align    : center;
    cursor        : pointer;
    padding       : 8px 12px;
    background    : rgba(0, 127, 255, 0.1);
    color         : rgba(0, 127, 255, 0.87);
    line-height   : 1em;
    transition    : .3s;
    border        : 2px solid rgba(0, 127, 255, 0.87);
    float         : right;
    position      : relative;
    top           : 3px;
    left          : 90px;
    }
    </style>

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

<div style="text-align:right; padding-top:5px; padding-right:9px; color:gray;">{{ Auth::user()->name }}さんがログイン中</div>
<div style="text-align:center; margin-top:50px; margin-bottom:0px; display:inleine-block; font-size:19px;">{{ Auth::user()->name }}さんのuploadページ</div>
<div style="width:120px; position:absolute; right:0px; ">
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

<hr style="display:block; margin-top:41px;"/>

<div style="text-align:center; margin-top:20px;">
<form
  method="post"
  action="{{ route('upload_image') }}"
  enctype="multipart/form-data"
>
  @csrf
  <div class="file-select"><input type="file" name="file_path" accept="image/png, image/jpeg" onchange="previewImage(this);"></div>
  <div class="name-input"><label for="">商品名：</label><input type="text" name="goods_name"></div>
  <div class="price-input"><label for="">価格：</label><input type="text" name="goods_price"></div>
  <div style="display:inline-block; text-align:center;"><p style="float:left; position:relative; right:100px; top:64px;">Preview:</p><p><input type="submit" value="登録" class="file-register"></p></div>
</form>
<div>
<img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="width: 246px; height: 246px;">
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