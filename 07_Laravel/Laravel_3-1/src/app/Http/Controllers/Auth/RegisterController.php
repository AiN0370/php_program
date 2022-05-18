<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }

    /**
     *  ユーザー登録画面を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('auth.register', [
            'roles' => Role::all()
        ]);
    }
    /**
     * 新しく作られたユーザーデータを保存する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
    
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth()->attempt($request->only('email', 'password'));

        // 一般　Role を新しいユーザーにつける
        $role = $request->role;
        $user->roles()->attach($role);
        
        return redirect('dashboard');
    }
}
