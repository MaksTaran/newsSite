@extends('layouts.app')

@section('content')
    <h1>Новости (из БД)</h1>
    @foreach($articles as $article)
        <div style="border-bottom: 1px solid #ccc; margin-bottom: 20px;">
            <h2>{{ $article->title }}</h2>
            <p><small>Дата: {{ \Carbon\Carbon::parse($article->published_at)->format('d.m.Y') }}</small></p>
            <p>{{ Str::limit($article->content, 150) }}</p>
            @if($article->preview_image)
                <img src="{{ asset($article->preview_image) }}" width="100">
            @endif
            <hr>
        </div>
    @endforeach
@endsection