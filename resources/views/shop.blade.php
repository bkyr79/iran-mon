<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $owner_name }}さんのショップ</title>
    <link href="{{ asset('/css/shop.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

<!-- Bootstrap導入 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- Bootstrap Javascript(jQuery含む) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- ユーザー名を表示 -->
<!-- これは間違え。改善要 → ×ログイン中のユーザー ○他ショップのオーナー（=他ユーザー） -->
    <div class="login-state">{{ Auth::user()->name }}さんがログイン中</div>
    <div class="shop-title">{{ $owner_name }}さんのショップ</div>
    <div class="acc-menu">
    <ul class="header-dropmenu">
    <li>
        <a href="#" class="menu-btn">メニュー</a>
        <ul>
        <li><a href="{{ url('/list') }}">マイページ</a></li>
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
    <!-- nameプロバティとvalueプロパティがポイント -->
    <button type="button" class="buy-confirm btn btn-success" name="id[]" value="{{ $image->id }}" data-toggle="modal" data-target="#confirm-buy">
        <img src="{{ Storage::url($image->file_path) }}"/>
        <div><div class="goods-name">{{ $image->name }}　</div><div class="goods-price">¥{{ $image->price }}</div></div>
    </button>
@endforeach
</div>
<div class="bottom-pagi">{{ $images->links() }}</div>

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

</body>
</html>