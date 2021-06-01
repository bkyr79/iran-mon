<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
<link href="{{ asset('/css/item_list.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

<!-- Bootstrap導入 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- Bootstrap Javascript(jQuery含む) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- ユーザー名を表示 -->
<div class="login-state">{{ Auth::user()->name }}さんがログイン中</div>
<div class="mypage-title">{{ Auth::user()->name }}さんのマイページ</div>
<div class="acc-menu">
<ul class="header-dropmenu">
  <li>
    <a href="#" class="menu-btn">メニュー</a>
    <ul>
      <li><a href="{{ url('/shoplist') }}">ショップ一覧へ</a></li>
      <li><a href="{{ route('upload_form') }}">Upload</a></li>
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

<div class="top-pagi">{{ $images->links() }}</div>
<div class="image-list">
@foreach($images as $image)
<div type="button" class="delete-confirm btn btn-success" value="A001" data-toggle="modal" data-target="#confirm-delete">
  <form action="/itemlist" name="sampleform" method="post" onsubmit="return func1()">
  @csrf
  <button type="submit" class="image-btn">
    <img src="{{ Storage::url($image->file_path) }}"/>
  </button>
  <input type="text" class="goods_name" name="goods_name" value="{{ $image->name }}">
  <input type="hidden" name="id" value="{{ $image->id }}">
  </form>
</div>
@endforeach
</div>
<div class="bottom-pagi">{{ $images->links() }}</div>

<script>
jQuery(function($){
    $('.goods_name').click(function(){
        //classでonを持っているかチェック
        if(!$(this).hasClass('on')){
            //編集可能時はclassでonをつける
            $(this).addClass('on');
            var txt = $(this).text();
            //テキストをinputのvalueに入れてで置き換え
            $(this).html('<input type="text" value="'+txt+'" />');
            //同時にinputにフォーカスをする
            $('.goods_name > input').focus().blur(function(){
                var inputVal = $(this).val();
                //もし空欄だったら空欄にする前の内容に戻す
                if(inputVal===''){
                    inputVal = this.defaultValue;
                };
                //編集が終わったらtextで置き換える
                $(this).parent().removeClass('on').text(inputVal);                
            });
        };

    });
});
</script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</body>
</html>