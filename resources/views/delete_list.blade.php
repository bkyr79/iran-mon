<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除ページ</title>
    <link href="{{ asset('/css/delete_list.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div class="login-state">{{ Auth::user()->name }}さんがログイン中</div>
<div class="deletepage-title">{{ Auth::user()->name }}さんの削除ページ</div>
<div class="acc-menu">
<ul class="header-dropmenu">
  <li>
    <a href="#" class="menu-btn">メニュー</a>
    <ul>
      <li><a href="{{ url('/list') }}">マイページに戻る</a></li>
      <li><a href="{{ route('upload_form') }}">Upload</a></li>
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

<div>
<div class="top-pagi">{{ $images->links() }}</div>
<div><button type="submit" form="delete_form" class="dele-btn">削除する</button></div>
</div>

<!-- ↓formタグはループの外に記述する -->
<form action="/delete" id="delete_form" method="post">

<div class="image-list">
@foreach($images as $image)
<div class="delete-confirm btn btn-success" value="A001" data-toggle="modal" data-target="#confirm-delete">
  @csrf
  <input type="checkbox" name="del_checks[]" value="{{ $image->id }}">
  <div class="delepage-img">
    <img src="{{ Storage::url($image->file_path) }}"/>
  </div>
  <p class="goods_name"><span>{{ $image->name }}</span></p>
</div>
@endforeach
</div>
<div class="bottom-pagi">{{ $images->links() }}</div>

</form>

</body>
</html>