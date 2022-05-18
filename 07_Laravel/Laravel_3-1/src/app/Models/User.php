<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';
    /**
     * 一括割り当て可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 
    ];

    /**
     * 配列に対して非表示にする必要がある属性
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * ネイティブタイプにキャストする必要がある属性
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasAnyRoles($roles){
        if($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }
        return false;
    }
    public function hasRole($role){
        if($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function status() {
        return $this->belongsToMany('App\Models\Status');
    }
}
