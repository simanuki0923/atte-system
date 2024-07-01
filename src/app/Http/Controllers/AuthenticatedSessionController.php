<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login'); // Show the login form
    }

    public function store(Request $request)
    {
        // Validate login credentials
      $credentials = $request->validate([
            
        
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            
      
        $request->session()->regenerate();
        return redirect()->intended('/'); // Redirect to home page after successful login
        }

        // Authentication failed, redirect back with error message
    }
        public function destroy(Request $request)
    {
    
       Auth::logout(); // ログアウト処理
        
      $request->session()->invalidate(); // セッションの無効化
    
      $request->session()->regenerateToken(); // CSRF トークンの再生成
       return redirect('/'); // ログアウト後はホームページにリダイレクト
    }
   
}