<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Article $article): bool { return true; }
    public function create(User $user): bool { return $user->hasRole('moderator'); }
    public function update(User $user, Article $article): bool { return $user->hasRole('moderator'); }
    public function delete(User $user, Article $article): bool { return $user->hasRole('moderator'); }
}