<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="<?= csrf_token() ?>">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <script type="text/javascript" src="{{ asset("js/app.js") }}" defer></script>
    <title>{{ env("APP_NAME") }}</title>
    @stack("head")
</head>
<body>
@yield("body")
</body>
</html>
