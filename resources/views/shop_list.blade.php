@extends('layouts.typical')
@section('title', 'ショップ一覧ページ')

@section('stylesheet')
  <link href="{{ asset('/css/shop_list.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')
  <!-- Bootstrap導入 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- Bootstrap Javascript(jQuery含む) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <div class="login-state">{{ Auth::user()->name }}さんがログイン中</div>
  <div class="shoplist-title">ショップ一覧</div>
  <div class="acc-menu">
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

  <hr class="sepa-border"/>
  <div class="shoplist-content">

  {{ $userid_of_items }}
  {{ $id_of_users }}
<!-- @if($intersect = true) -->
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
<!-- @endif -->

  </div>
@endsection