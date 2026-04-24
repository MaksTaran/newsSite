<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Показать форму регистрации
    public function create()
    {
        return view('auth.signin');
    }

    // Обработать отправку формы и вернуть JSON
    public function registration(Request $request)
    {
        // Валидация
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Если валидация успешна, собираем данные в массив
        $validated = $validator->validated();

        // JSON-ответ
        return response()->json([
            'success' => true,
            'message' => 'Валидация пройдена успешно',
            'data' => $validated
        ]);
    }
}