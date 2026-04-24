@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Вход</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div><label>Email:</label><input type="email" name="email" value="{{ old('email') }}"></div>
        <div><label>Пароль:</label><input type="password" name="password"></div>
        <div><input type="checkbox" name="remember"> Запомнить меня</div>
        <button type="submit">Войти</button>
    </form>
    <p>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
</div>
@endsection