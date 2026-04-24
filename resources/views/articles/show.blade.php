@extends('layouts.app')

@section('content')
    <h1>{{ $article->title }}</h1>
    <p><small>{{ $article->published_at?->format('d.m.Y') }}</small></p>
    <p>{{ $article->content }}</p>
    @if($article->full_image)
        <img src="{{ asset($article->full_image) }}" style="max-width:100%;">
    @endif
    <p><a href="{{ route('articles.index') }}">Назад</a></p>

    @auth
    @can('create', App\Models\Comment::class)
        <form method="POST" action="{{ route('comments.store', $article) }}">
            @csrf
            <textarea name="content" required placeholder="Ваш комментарий"></textarea>
            <button type="submit">Отправить</button>
        </form>
    @endcan
@else
    <p><a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.</p>
@endauth

@foreach($article->comments as $comment)
    <div>
        <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
        @can('delete', $comment)
            <form method="POST" action="{{ route('comments.destroy', $comment) }}" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        @endcan
    </div>
@endforeach
@endsection