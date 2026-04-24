<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой сайт</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <header>
        <nav>
    <a href="/">Главная</a>
    <a href="/about">О нас</a>
    <a href="/contacts">Контакты</a>
    <a href="/articles">Новости</a>
    @auth
        <span>{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Выйти</button>
        </form>
    @else
        <a href="{{ route('login') }}">Вход</a>
        <a href="{{ route('register') }}">Регистрация</a>
    @endauth
</nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Таран М.В., группа 243-321</p>
    </footer>
</body>
</html>