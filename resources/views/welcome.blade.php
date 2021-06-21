<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ira-mon</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <link href="{{ asset('/css/welcome.css') }}" rel="stylesheet" type="text/css">

        <style>
        /* ダイアログ */
        .ui-icon ui-icon-alert {
            float: left;
            margin: 0 7px 20px 0;
        }
        .ui-dialog-titlebar {
            color: #ffffff;
            background: green;
        }
        </style>
    </head>
    <body>
        <!-- <div id="dialog-confirm" title="">
        <p>
        <span class="ui-icon ui-icon-alert"></span>
        再ログインできませんが、よろしいですか？
        </p>
        </div> -->
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/list') }}">My page</a>
                    @else
                        <form action="{{ url('guest_login') }}">
                        <button type="submit" class="easy-login" id="easyLogin"></button>
                        </form>

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
        <!-- ダイアログ表示の実装 -->
        <script>
            // $(function easyLoginDialog() {
            // $( "#dialog-confirm" ).dialog({
            //     modal: true,
            //     buttons: {
            //     "はい": function() {
            //         $( this ).dialog( "close" );
            //     },
            //     "いいえ": function() {
            //         $( this ).dialog( "close" );
            //     }
            //     }
            // });
            // });
            
            // let button = document.getElementById('easyLogin');
            // button.addEventListener('click', easyLoginDialog);
        </script>
    </body>
</html>
