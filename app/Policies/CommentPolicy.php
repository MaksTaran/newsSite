<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Comment $comment): bool { return true; }

    // Только зарегистрированные пользователи (и читатель, и модератор) могут создавать комментарии
    public function create(User $user): bool
    {
        return $user->hasRole('reader') || $user->hasRole('moderator');
    }

    // Обновлять комментарий может только модератор
    public function update(User $user, Comment $comment): bool
    {
        return $user->hasRole('moderator');
    }

    // Удалять комментарий может только модератор
    public function delete(User $user, Comment $comment): bool
    {
        return $user->hasRole('moderator');
    }
}