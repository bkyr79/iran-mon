<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  @yield('stylesheet')
  <link href="{{ asset('/css/dropmenu.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
@yield('body')
</body>
</html>