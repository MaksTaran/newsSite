@extends('layouts.app')

@section('content')
    <h1>Контакты</h1>
    <ul>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
        <li><strong>Телефон:</strong> {{ $data['phone'] }}</li>
        <li><strong>Адрес:</strong> {{ $data['address'] }}</li>
    </ul>
@endsection