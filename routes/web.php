<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SanctumAuthController; // новый контроллер для Sanctum
use Illuminate\Support\Facades\Route;
// Публичные маршруты (доступны всем)
Route::get('/', [MainController::class, 'index']); // главная с JSON
Route::get('/about', function () {
    return view('about');
});
Route::get('/contacts', function () {
    $contactsData = [
        'email' => 'info@example.com',
        'phone' => '+7 (999) 123-45-67',
        'address' => 'г. Москва, ул. Лесная, д. 5'
    ];
    return view('contacts', ['data' => $contactsData]);
});
Route::get('/gallery/{id}', [MainController::class, 'gallery']); // галерея

// Список новостей и просмотр одной – открыты всем
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Гостевые маршруты для аутентификации
Route::get('/register', [SanctumAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [SanctumAuthController::class, 'register']);
Route::get('/login', [SanctumAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [SanctumAuthController::class, 'login']);
Route::post('/logout', [SanctumAuthController::class, 'logout'])->name('logout');

// Защищённые маршруты (требуют аутентификации через sanctum)
Route::middleware(['auth:sanctum'])->group(function () {
    // Главная после логина
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // CRUD для новостей (create, store, edit, update, destroy) – только авторизованным
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});