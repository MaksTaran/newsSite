@extends('layouts.app')

@section('content')
    <h1>Полноразмерное изображение</h1>
    <img src="{{ asset($fullImage) }}" alt="full image" style="max-width:100%;">
    <p><a href="/">Вернуться на главную</a></p>
@endsection