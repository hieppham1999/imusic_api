<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('languages')->insert([
            [
                'name' => 'Vietnamese',
            ],
            [
                'name' => 'English',
            ],
            [
                'name' => 'Chinese',
            ],
            [
                'name' => 'Japanese',
            ],
            [
                'name' => 'French',
            ],
            [
                'name' => 'Korean',
            ],
            [
                'name' => 'Russian',
            ],
            [
                'name' => 'Turkish',
            ],
        ]);
    }
}
