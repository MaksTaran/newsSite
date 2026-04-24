<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SanctumAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Регистрация успешна. Войдите.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $user = Auth::user();
            // Создаём токен для веб-доступа (требование лабораторной)
            $token = $user->createToken('web-token')->plainTextToken;
            // Опционально: сохраняем токен в сессии (если нужен для API)
            session(['api_token' => $token]);

            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'email' => ['Неверный email или пароль.'],
        ]);
    }

    public function logout(Request $request)
    {
        // Удаляем текущий токен
        $request->user()?->currentAccessToken()?->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}