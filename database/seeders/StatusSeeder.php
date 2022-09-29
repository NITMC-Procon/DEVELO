<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Status::create([
            'status' => '構想中'
        ]);
        Status::create([
            'status' => '開発中'
        ]);
        Status::create([
            'status' => '開発終了'
        ]);
        Status::create([
            'status' => '停止中'
        ]);
    }
}
