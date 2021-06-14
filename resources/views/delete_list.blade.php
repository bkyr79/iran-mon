@extends('layouts.filelist')
@section('title', '削除ページ')

@section('stylesheet')
  <link href="{{ asset('/css/delete_list.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('header')
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
@endsection

@section('div')
  <div>
@endsection

@section('content')
  <div><button type="submit" form="delete_form" class="dele-btn">削除する</button></div>
  </div>
  <!-- ↓formタグはループの外に記述する -->
  <form action="/delete" id="delete_form" method="post">
  <div class="image-list">
  @foreach($images as $image)
  <div class="delete-confirm btn btn-success" value="A001" data-toggle="modal" data-target="#confirm-delete">
    @csrf
    <input type="checkbox" name="del_checks[]" value="{{ $image->id }}">
    <input type="hidden" name="del_image[]" value="{{ $image->file_path }}">
    <div class="delepage-img">
      <img src="{{ Storage::disk('s3')->url($image->file_path) }}"/>
    </div>
    <p class="goods_name"><span>{{ $image->name }}</span></p>
  </div>
  @endforeach
  </div>
@endsection

@section('footer')
  </form>
@endsection