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
    </style>
</head>
<body>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div style="text-align:right; padding-top:5px; padding-right:9px; color:gray;">{{ Auth::user()->name }}さんがログイン中</div>
<div style="text-align:center; margin-top:50px; margin-bottom:0px; display:inleine-block; font-size:19px;">{{ Auth::user()->name }}さんの削除ページ</div>
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

<p><button type="submit" form="delete_form">削除する</button></p>

<!-- ↓formタグはループの外に記述する -->
<form action="/delete" id="delete_form" method="post">

<div style="text-align:center;">
@foreach($images as $image)
<div class="delete-confirm btn btn-success" value="A001" data-toggle="modal" data-target="#confirm-delete" style="width: 18rem; margin: 16px; height: 290px;">
  @csrf
  <input type="checkbox" name="del_checks[]" value="{{ $image->id }}">
  <button style="width: 100%; display: inline-block; padding: 0px; border: 0px;">
    <img src="{{ Storage::url($image->file_path) }}" style="width: 100%; height: 246px;"/>
  </button>
  <p class="goods_name" style="display:block; margin:auto; text-align:center; border:#28a745; background-color:#28a745; font-weight:bold;"><span style="color:black;">{{ $image->name }}</span></p>
</div>
@endforeach
</div>

</form>

</body>
</html>