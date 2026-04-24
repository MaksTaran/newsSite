<!DOCTYPE html>
<html>
<head>
    <title>Новая статья</title>
</head>
<body>
    <h1>Опубликована новая статья</h1>
    <p><strong>Заголовок:</strong> {{ $article->title }}</p>
    <p><strong>Дата публикации:</strong> {{ $article->published_at ? $article->published_at->format('d.m.Y') : 'не указана' }}</p>
    <p><strong>Краткое содержание:</strong></p>
    <p>{{ Str::limit($article->content, 200) }}</p>
    <p>
        <a href="{{ route('articles.show', $article) }}">Читать полностью</a>
    </p>
    <hr>
    <small>Это письмо отправлено автоматически. Не отвечайте на него.</small>
</body>
</html>