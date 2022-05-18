<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * ユーザーをログアウトする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function store() {
        auth()->logout();

        return redirect()->route('home')->with('message', 'ログアウトしました');
    }
}
