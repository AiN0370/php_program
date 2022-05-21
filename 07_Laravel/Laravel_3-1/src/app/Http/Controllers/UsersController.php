<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * ユーザーのダッシュボードページを表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $user = auth()->user();
        return view('dashboard')->with([
            'users' => $users,
            'user' => $user
        ]);
    }

    /**
     * ユーザー情報を編集するためのフォームを表示する
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $status = Status::all();
      
        return view('edit')->with([
            'user' => $user,
            'roles' => $roles,
            'status' => $status
        ]);
    }

    /**
     * 保存されているユーザーの情報を更新する
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $status = $user->status->pluck('name');

        // admin ユーザーは全ての情報を更新できる
        if (auth()->user()->hasRole('admin')) {
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->role) {
                $user->roles()->sync($request->roles);
            }
            if ($request->status) {
                $user->status()->sync($request->status);
            }
            $user->save();
            return back()->with('message', 'ユーザー情報がアップデートされました。');
        } 
        // 管理者ユーザーは申請ステータスと自分の情報のみ更新ができる
        elseif (auth()->user()->hasRole('管理者')) { 
            if ($request->username) { 
                $user->username = $request->username;
            }
            if ($request->email) { 
                $user->email = $request->email;
            }
            if ($request->status) {
                $user->status()->sync($request->status);
            }
            $user->save();
            return back()->with('message', 'ユーザー情報がアップデートされました。');
        } 
        // 申請ステータスが「確認待ち」かつ申請を出した本人のみ承認申請の修正ができる
        elseif ($status->contains('確認待ち') || empty($status->toArray())){
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->status) {
                $user->status()->sync($request->status);
            }
            $user->save();
            
            return back()->with('message', 'ユーザー情報がアップデートされました。');
        } 
        // 登録した本人は、「確認中」から「破棄」にステータスが変更できる
        elseif ($status->contains('確認中') && $request->status) {
            $user->status()->sync($request->status);
            $user->save();
            
            return back()->with('alert', '申請が破棄されました。');
        }
        
        return back()->with('alert', '現在ユーザー情報は編集できません');
    }

    /**
     * ユーザー情報を削除する
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // admin 権限を持つユーザーと本人のみユーザーデータを削除できる。
        if(Gate::allows('edit-user') || auth()->user()->id === $user->id){
            $user->roles()->detach();
            $user->delete();
            return redirect()->route('home')->with('alert', 'ユーザーが削除されました');
        } else{
            return back()->with('alert', '本人以外はユーザーを削除できません');
        }
    }
}
