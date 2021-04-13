<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
            'name' => 'Phạm Tuấn Hiệp',
            'email' => 'hieppham1999@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
            'name' => 'Vương Thị Bích Ngọc',
            'email' => 'vuongngoc1999@gmail.com',
            'role' => 'user',
            'password' => Hash::make('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
            'name' => 'Phạm Trung Hiếu',
            'email' => 'hieupham1993@live.com',
            'role' => 'user',
            'password' => Hash::make('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
            'name' => 'Đoàn Đức Dũng',
            'email' => 'dungdidom1101@gmail.com',
            'role' => 'user',
            'password' => Hash::make('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
