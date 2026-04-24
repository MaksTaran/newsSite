@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Новости (из БД)</h1>
            <a href="{{ route('articles.create') }}" class="btn btn-success">Создать новость</a>
        </div>

        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($article->preview_image)
                            <img src="{{ asset($article->preview_image) }}" class="card-img-top" alt="Превью" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-white">Нет изображения</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted">
                                <small>Дата: {{ \Carbon\Carbon::parse($article->published_at)->format('d.m.Y') }}</small>
                            </p>
                            <p class="card-text">{{ Str::limit($article->content, 120) }}</p>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-primary">Редактировать</a>
                                <form method="POST" action="{{ route('articles.destroy', $article) }}" onsubmit="return confirm('Удалить статью?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection