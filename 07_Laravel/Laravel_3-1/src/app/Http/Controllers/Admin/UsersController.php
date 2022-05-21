<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * ユーザーリストを表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
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
        
        return view('admin.users.edit')->with([
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
        $user->roles()->sync($request->roles);
        $user->status()->sync($request->status);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect(route('admin.users.index'))->with('message', 'ユーザー情報がアップデートされました。');
    }

    /**
     * ユーザー情報を削除する
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('message', 'ユーザー情報が削除されました。');
    }
}
