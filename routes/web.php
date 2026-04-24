<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/signin', [AuthController::class, 'create']);
Route::post('/signin', [AuthController::class, 'registration']);

Route::get('/', [MainController::class, 'index']);
Route::get('/gallery/{id}', [MainController::class, 'gallery']);
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