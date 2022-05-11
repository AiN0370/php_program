<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //  ユーザー登録の画面を表示する
    public function create() {
        return view('users.register');
    }

    // 新しくユーザーを作る
    public function store(Request $request) {
        $formFields = $request->validate([
           'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|min:6'
        ]);

        // パスワードをハッシュ化
        $formFields['password'] = bcrypt($formFields['password']);

        // ユーザーを作成
        $user = User::create($formFields);

        // ユーザーをログイン
        auth()->login($user);
        return redirect('/')->with('message', '新しくユーザーが作成されました');
    }

    // ユーザーをログアウトする
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'ログアウトしました');

    }

    // ログインフォームを表示する
    public function login() {
        return view('users.login');
    }

    // ユーザーを照合する
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'ログインしました!');
        }
        return back()->withErrors(['email' => 'ユーザー情報が一致しません'])->onlyInput('email');
    }
}
