<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\Comment;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Глобальный шлюз (хук) – модератору всё разрешено
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('moderator')) {
                return true;
            }
        });
    }
}