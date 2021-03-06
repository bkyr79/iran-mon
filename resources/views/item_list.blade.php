@extends('layouts.filelist')
@section('title', 'マイページ')

@section('stylesheet')
  <link href="{{ asset('/css/item_list.css') }}" rel="stylesheet" type="text/css">
@endsection

<!-- マイページに商品が無い場合にalertを開く -->
@if($data_count === 0)
  @section('tutorial-pop')
    <dialog class="tutorial">
          <p>商品を登録しよう！商品は<span>メニュー</span>からuploadするか、ショップで購入できます</p>
      <div>
        <button id='closebutton'>閉じる</button>
      </div>
    </dialog>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="js/jquery.layerBoard.js"></script>

    <script>
    $(function(){
      $('.tutorial').toggleClass('visible');
    })

    closebutton.onclick = () => {
      $('.visible').toggleClass('tutorial');
    }
    </script>
  @endsection
@endif

@section('header')
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
@endsection

@if($data_count != 0)
  @section('favorite-btn')
  <div class="fav">
  @if($not_fav_count > 0)
  <button class="fav-btn">
    <a href="{{ route('favorite_select') }}" style="text-decoration:none; display:block">
    <span><img src="{{ Storage::disk('s3')->url('myprefix/1745 21.53.32 21.58.53.png') }}" class="title-fav-star"></span>
    お気に入り選択
    </a>
  </button>
  @endif
  @if($fav_count > 0)
  <button class="fav-clear-btn"><a href="{{ route('favorite_select_clear') }}" style="text-decoration:none; display:block">お気に入り解除</a></button>
  @endif
</div>
  @endsection
@endif

@section('content')
  <div class="image-list">

  @foreach($images as $image)

  @if (session('get_new_sign') && $image === $images[0])
  <div type="button" class="delete-confirm btn-f btn shine" value="A001" data-toggle="modal" data-target="#confirm-delete">
  @else
  <div type="button" class="delete-confirm btn-f btn" value="A001" data-toggle="modal" data-target="#confirm-delete">
  @endif

    <form action="/itemlist" name="sampleform" method="post" onsubmit="return func1()" class="main-form">
    @csrf
    <button type="submit" class="image-btn">
      <img src="{{ Storage::disk('s3')->url($image->file_path) }}"/>
    </button>
    <input type="text" class="goods_name" name="goods_name" value="{{ $image->name }}">
    @if($image->favorite === 1)
    <img src="{{ Storage::disk('s3')->url('myprefix/1745 21.53.32 21.58.53.png') }}" class="fav-star">
    @endif
    <input type="hidden" name="id" value="{{ $image->id }}">
    </form>
    <form action="" id="fav_btn" method="post">
      @csrf
      <input type="checkbox" class="fav-check" name="fav_checks[]" value="{{ $image->id }}" style="display:none;">
    </form>
  </div>

  @endforeach
  </div>
@endsection

@section('footer')
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
@endsection