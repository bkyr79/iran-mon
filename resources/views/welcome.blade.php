<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ira-mon</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <link href="{{ asset('/css/welcome.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/list') }}">My page</a>
                    @else
                        <!-- <form action="{{ url('guest_login') }}">
                        <input type="submit" value="簡単LOGIN">
                        </form> -->
                        <button type="button" class="" data-toggle="modal" data-target="#easy-login">簡単ログイン</button>

                        <a href="{{ route('login') }}" class="login">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="register">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    ira-mon
                </div>

                <div class="links">
                不要なものを写真にして面白おかしく売り買いしよう
                </div>
            </div>
        </div>

        <div class="modal fade" id="easy-login" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        再ログインできませんが、よろしいですか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                        <form action="{{ url('guest_login') }}">
                        @csrf
                        <input type="submit" value="はい">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
        // // 確認画面で「はい」クリックしたら、buy-confirmクラス属性の値が渡される
        // $('.buy-confirm').click(function(){
        //     $('#buybtn').val( $(this).val() );
        // });
        </script>
    </body>
</html>
