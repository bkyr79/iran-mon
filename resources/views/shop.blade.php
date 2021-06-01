@extends('layouts.master')
@section('title', '{{ $owner_name }}さんのショップ')

@section('stylesheet')
    <link href="{{ asset('/css/shop.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('header')
    <div class="shop-title">{{ $owner_name }}さんのショップ</div>
        <div class="acc-menu">
        <ul class="header-dropmenu">
        <li>
            <a href="#" class="menu-btn">メニュー</a>
            <ul>
            <li><a href="{{ url('/list') }}">マイページ</a></li>
            <li><a href="{{ url('/shoplist') }}">ショップ一覧へ</a></li>
            <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">ログアウト</a></li>
            </ul>
        </li>
        </ul>
        </div>
@endsection

@section('content')
    <div class="image-list">
    @foreach($images as $image)
        <!-- nameプロバティとvalueプロパティがポイント -->
        <button type="button" class="buy-confirm btn btn-success" name="id[]" value="{{ $image->id }}" data-toggle="modal" data-target="#confirm-buy">
            <img src="{{ Storage::url($image->file_path) }}"/>
            <div><div class="goods-name">{{ $image->name }}　</div><div class="goods-price">¥{{ $image->price }}</div></div>
        </button>
    @endforeach
    </div>
@endsection

@section('footer')
    <!-- Modal -->
    @foreach($images as $image)
    <div class="modal fade" id="confirm-buy" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">確認</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    購入しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                    <!-- 商品imageと同じidを持たせることで、同じvalueを持たせることになる -->
                    <form action="/list" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success" id="buybtn" name="id[]">はい</button>
                    <input type="hidden" name="shop_id" value="{{ $owner_id }}">
                    <input type="hidden" name="id[]" value="{{ $image->id }}">
                    <!-- 所有権をログインユーザー(買い手)に変更するために、 buyer_idに値をもたせる-->
                    <input type="hidden" name="buyer_id" value="{{ Auth::user()->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        // 確認画面で「はい」クリックしたら、buy-confirmクラス属性の値が渡される
        $('.buy-confirm').click(function(){
            $('#buybtn').val( $(this).val() );
        });
    </script>
@endsection