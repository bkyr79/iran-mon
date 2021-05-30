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
    .shop-name {
    display       : inline-block;
    border-radius : 3%;
    font-size     : 14pt;
    text-align    : center;
    cursor        : pointer;
    padding       : 12px 12px;
    background    : rgba(0, 127, 255, 0.1);
    color         : rgba(0, 0, 0, 0.71);
    line-height   : 1em;
    transition    : .3s;
    box-shadow    : 2px 2px 4px #666666;
    border        : 2px solid rgba(0, 127, 255, 0.87);
    }
    .shop-name:hover {
    box-shadow    : none;
    color         : rgba(0, 127, 255, 0.87);
    background    : rgba(0, 0, 0, 0.22);
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

<div style="text-align:right; padding-top:5px; padding-right:9px; color:gray;">{{ Auth::user()->name }}さんがログイン中</div>
<div style="text-align:center; margin-top:50px; margin-bottom:0px; display:inleine-block; font-size:19px;">ショップ一覧</div>
<div style="width:120px; position:absolute; right:0px; ">
<ul class="header-dropmenu">
  <li>
    <a href="#" class="menu-btn">メニュー</a>
    <ul>
      <li><a href="{{ url('/list') }}">マイページに戻る</a></li>
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
<div style="text-align:center; margin-top:80px;">
@foreach($shop_owner_id as $one_id)
    <form action="/shop" method="post">
    @csrf
    @if($one_id->id <> Auth::user()->id )
    <input type="submit" class="shop-name" value="{{ $one_id->name }}さんのショップ">
    <input type="hidden" name="owner_id" value="{{ $one_id->id }}">
    <input type="hidden" name="owner_name" value="{{ $one_id->name }}">
    @endif
    </form>
@endforeach
</div>

</body>
</html>