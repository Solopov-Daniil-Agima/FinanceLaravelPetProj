<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Все транзакции пользователей</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<header>
    <h1>
       Финансы - расходы и доходы
    </h1>
</header>
<main class="main">
    <div class="">
        @if($UserGroup == 1)
            {{view('transactions.Admin', $Info)}}
        @else($UserGroup !== 1)
            {{view('transactions.User', $Info)}}
        @endif
    </div>
</main>

</body>
    <style>
        h1 {
            width: 100%;
            text-align: center;
        }
    </style>
</html>
