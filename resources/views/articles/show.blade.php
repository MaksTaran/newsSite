@extends('layouts.app')

@section('content')
    <h1>{{ $article->title }}</h1>
    <p><small>{{ $article->published_at?->format('d.m.Y') }}</small></p>
    <p>{{ $article->content }}</p>
    @if($article->full_image)
        <img src="{{ asset($article->full_image) }}" style="max-width:100%;">
    @endif
    <p><a href="{{ route('articles.index') }}">Назад</a></p>
@endsection