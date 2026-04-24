<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests; // добавляем трейт для авторизации

    // Список новостей (с пагинацией) – доступен всем
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(5);
        return view('articles.index', compact('articles'));
    }

    // Просмотр одной статьи – доступен всем
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // Форма создания новой статьи – только модератор
    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }

    // Сохранение новой статьи – только модератор
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:10',
            'preview_image' => 'nullable|string|max:255',
            'full_image' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        Article::create($validated);
        return redirect()->route('articles.index')->with('success', 'Статья создана.');
    }

    // Форма редактирования статьи – только модератор
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    // Обновление статьи – только модератор
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:10',
            'preview_image' => 'nullable|string|max:255',
            'full_image' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        $article->update($validated);
        return redirect()->route('articles.index')->with('success', 'Статья обновлена.');
    }

    // Удаление статьи – только модератор
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья удалена.');
    }
}