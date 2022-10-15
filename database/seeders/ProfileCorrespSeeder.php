<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfileCorresp;

class ProfileCorrespSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProfileCorresp::create([
            'column_name' => 'gender',
            'data_name' => '性別'
        ]);
        ProfileCorresp::create([
            'column_name' => 'address',
            'data_name' => '住所'
        ]);
        ProfileCorresp::create([
            'column_name' => 'yearsold',
            'data_name' => '年齢'
        ]);
    }
}
