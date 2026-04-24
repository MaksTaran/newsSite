@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Регистрация</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div><label>Имя:</label><input type="text" name="name" value="{{ old('name') }}"></div>
        <div><label>Email:</label><input type="email" name="email" value="{{ old('email') }}"></div>
        <div><label>Пароль:</label><input type="password" name="password"></div>
        <div><label>Подтверждение пароля:</label><input type="password" name="password_confirmation"></div>
        <button type="submit">Зарегистрироваться</button>
    </form>
    <p>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
</div>
@endsection