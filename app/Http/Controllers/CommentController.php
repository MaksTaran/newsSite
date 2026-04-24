<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $this->authorize('create', Comment::class);

        $request->validate([
            'content' => 'required|string|min:1|max:1000',
        ]);

        $article->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Комментарий добавлен');
    }

    // удаление комментария (только модератор)
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->back()->with('success', 'Комментарий удалён');
    }
}