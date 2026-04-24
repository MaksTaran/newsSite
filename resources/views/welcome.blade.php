@extends('layouts.app')

@section('content')
    <h1>Новости</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr><th>Изображение</th><th>Заголовок</th><th>Текст</th></tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>
                    <a href="/gallery/{{ $article['id'] }}">
                        <img src="{{ asset($article['preview_image']) }}" width="100">
                    </a>
                </td>
                <td>{{ $article['name'] }}</td>  {{-- было title, теперь name --}}
                <td>{{ $article['shortDesc'] ?? $article['desc'] }}</td>  {{-- короткое или полное описание --}}
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection