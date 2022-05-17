<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 管理者と admin ユーザーのみ
        Gate::define('edit-status', function($user) {
            return $user->hasAnyRoles(['admin', '管理者']);
        });

        // ユーザーの権限の修正は、admin 権限を持つユーザーのみできる
        Gate::define('edit-roles', function($user) {
            return $user->hasRole('admin');
        });

        // admin 権限を持つユーザーのみユーザー一覧画面にアクセスできる
        Gate::define('user-list', function($user) {
            return $user->hasRole('admin');
        });

        // ユーザー情報の編集は本人と admin 権限を持つユーザーのみできる
        Gate::define('edit-user', function($user) {
            return $user->hasRole('admin');
        });
    }
}
