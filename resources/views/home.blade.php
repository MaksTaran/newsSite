@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добро пожаловать, {{ Auth::user()->name }}</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Выйти</button>
    </form>
</div>
@endsection