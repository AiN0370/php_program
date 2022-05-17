<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ダッシュボードページを表示
        $users = User::all();
        $user = auth()->user();
        return view('dashboard')->with([
            'users' => $users,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $status = $user->status->pluck('name');

        // 管理者と admin ユーザーのみステータスの変更ができる。
        if (auth()->user()->hasAnyRoles(['admin', '管理者'])) {
            if($request->username ) {
                $user->username = $request->username;
            }
            if($request->email ) {
                $user->email = $request->email;
            }
            if($request->roles ) {
                $user->roles()->sync($request->roles);
            }
            $user->status()->sync($request->status);
            $user->save();
            
            return redirect(route('dashboard'))->with('message', 'ユーザー情報がアップデートされました。');
        } 
        // 申請ステータスが「確認待ち」かつ申請を出した本人のみ承認申請の修正ができる
        elseif ($status->contains('確認待ち') || empty($status->toArray())){
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->status) {
                $user->status()->sync($request->status);
            }
            $user->save();
            
            return redirect(route('dashboard'))->with('message', 'ユーザー情報がアップデートされました。');
        } 
        // 登録した本人は、「確認中」から「破棄」にステータスが変更できる
        elseif ($status->contains('確認中') && $request->status) {
            $user->status()->sync($request->status);
            $user->save();
            
            return redirect(route('dashboard'))->with('alert', '申請が破棄されました。');
        }
        
        return Redirect::back()->with('alert', '現在ユーザー情報は編集できません');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
