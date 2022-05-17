<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        DB::table('status_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', '管理者')->first();
        $userRole = Role::where('name', '一般')->first();

        $admin = User::create([
            'username' => 'Adminユーザー',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);
        $manager = User::create([
            'username' => '管理者ユーザー',
            'email' => 'manager@manager.com',
            'password' => Hash::make('password')
        ]);
        $user = User::create([
            'username' => '一般ユーザー',
            'email' => 'user@user.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);
        $user->roles()->attach($userRole);

        $pending = Status::where('name', '確認待ち')->first();
        $user->status()->attach($pending);
    }
}
