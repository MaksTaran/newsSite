@extends('layouts.app')

@section('content')
    <h1>Редактировать новость</h1>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('articles.update', $article) }}">
        @csrf
        @method('PUT')
        <div><label>Заголовок:</label><input type="text" name="title" value="{{ old('title', $article->title) }}"></div>
        <div><label>Текст:</label><textarea name="content">{{ old('content', $article->content) }}</textarea></div>
        <div><label>Превью (путь к файлу):</label><input type="text" name="preview_image" value="{{ old('preview_image', $article->preview_image) }}"></div>
        <div><label>Полное изображение:</label><input type="text" name="full_image" value="{{ old('full_image', $article->full_image) }}"></div>
        <div><label>Дата публикации:</label><input type="date" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d')) }}"></div>
        <button type="submit">Обновить</button>
    </form>
    <a href="{{ route('articles.index') }}">Назад к списку</a>
@endsection