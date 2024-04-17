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
                Админ страница
            </h1>
        </header>
        <main class="main">
            <div class="">
                <pre>
                    {{ dd($AdminInfo) }}
                </pre>
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>
