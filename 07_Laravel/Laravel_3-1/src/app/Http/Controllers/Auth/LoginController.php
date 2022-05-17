<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware(['guest']);
    }

    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $this -> validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('alert', 'ログイン情報が一致しません');
        } elseif(Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.users.index')->with('message', 'Adminとしてログインしました');
        } else {
            return redirect()->route('dashboard')->with('message', 'ログインしました!');
        }
        
    }
}
