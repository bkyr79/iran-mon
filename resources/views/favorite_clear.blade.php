@extends('layouts.filelist')
@section('title', 'お気に入り選択ページ')

@section('stylesheet')
  <link href="{{ asset('/css/delete_list.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('header')
  <div class="deletepage-title">お気に入り解除ページ</div>
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
@endsection

@section('div')
  <div>
@endsection

@section('content')
  <div>
    <button type="submit" form="fav_form" class="dele-clear-btn">解除する</button>
  </div>
  </div>
  <!-- ↓formタグはループの外に記述する -->
  <form action="/favorite_clear" id="fav_form" method="post">
  <div class="image-list">
  @foreach($images as $image)
  @if($image->favorite === 1)
  <div class="delete-confirm btn btn-success">
    @csrf
    <input type="checkbox" name="fav_checks[]" value="{{ $image->id }}">
    <div class="delepage-img">
      <img src="{{ Storage::disk('s3')->url($image->file_path) }}"/>
    </div>
    <p class="goods_name"><span>{{ $image->name }}</span></p>
  </div>
  @endif
  @endforeach
  </div>
@endsection

@section('footer')
  </form>
@endsection