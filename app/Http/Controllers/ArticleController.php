<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewArticleMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }

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

        $article = Article::create($validated);

        $moderator = User::whereHas('roles', function($q) {
            $q->where('name', 'moderator');
        })->first();

        if ($moderator) {
            try {
                Mail::to($moderator->email)->send(new NewArticleMail($article));
                Log::info('Письмо отправлено на ' . $moderator->email);
            } catch (\Exception $e) {
                Log::error('Ошибка отправки письма: ' . $e->getMessage());
            }
        }

        return redirect()->route('articles.index')->with('success', 'Статья создана.');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

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

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья удалена.');
    }
}