<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        $jsonPath = public_path('articles.json');
        $articles = json_decode(file_get_contents($jsonPath), true);

        // Добавляем каждому элементу поле 'id' = индекс массива
        foreach ($articles as $key => &$article) {
            $article['id'] = $key + 1; // 1,2,3...
        }

        return view('welcome', compact('articles'));
    }

    public function gallery($id)
    {
        $jsonPath = public_path('articles.json');
        $articles = json_decode(file_get_contents($jsonPath), true);

        // Добавляем id и ищем по нему
        foreach ($articles as $key => &$article) {
            $article['id'] = $key + 1;
        }

        $article = collect($articles)->firstWhere('id', (int)$id);

        if (!$article) {
            abort(404);
        }

        return view('gallery', ['fullImage' => $article['full_image']]);
    }
}