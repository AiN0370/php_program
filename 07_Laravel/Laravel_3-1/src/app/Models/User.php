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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
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

    public function isUser() {
        if (auth()->user()->id === $user->id || $user->hasRole('admin')) {
            return true;
        } else {
            return false;
        }
    }

    public function status() {
        return $this->belongsToMany('App\Models\Status');
    }
}
