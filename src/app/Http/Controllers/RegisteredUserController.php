<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
   public function create()
    {
        return view('register'); // 登録フォームのビューを返す
    }

    public function store(Request $request)
    {
        // バリデーションルールを定義
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // ユーザーをデータベースに保存
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // パスワードをハッシュ化
        ]);
    }
}