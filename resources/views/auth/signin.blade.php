@extends('layouts.app')

@section('content')
    <h1>Регистрация</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/signin">
        @csrf
        <div>
            <label>Имя:</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div>
            <label>Пароль:</label>
            <input type="password" name="password">
        </div>
        <button type="submit">Зарегистрироваться</button>
    </form>
@endsection