<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();

        Status::create(['name' => '承認済み']);
        Status::create(['name' => '確認中']);
        Status::create(['name' => '確認待ち']);
        Status::create(['name' => '破棄']);
    }
}
