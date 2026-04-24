<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Список новостей (с пагинацией)
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(5);
        return view('articles.index', compact('articles'));
    }

    // Форма создания новой статьи
    public function create()
    {
        return view('articles.create');
    }

    // Сохранение новой статьи (с валидацией)
    public function store(Request $request)
    {
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

    // Просмотр одной статьи (опционально)
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // Форма редактирования статьи
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    // Обновление статьи (с валидацией)
    public function update(Request $request, Article $article)
    {
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

    // Удаление статьи
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья удалена.');
    }
}