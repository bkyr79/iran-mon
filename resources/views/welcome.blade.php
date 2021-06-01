<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ira-mon</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <link href="{{ asset('/css/welcome.css') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/list') }}">My page</a>
                    @else
                        <form action="{{ url('guest_login') }}">
                        <input type="submit" value="簡単LOGIN" class="easy-login">
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
    </body>
</html>
