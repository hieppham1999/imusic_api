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
                'language_name' => 'Vietnamese',
            ],
            [
                'language_name' => 'English',
            ],
            [
                'language_name' => 'Chinese',
            ],
            [
                'language_name' => 'Japanese',
            ],
            [
                'language_name' => 'French',
            ],
            [
                'language_name' => 'Korean',
            ],
            [
                'language_name' => 'Russian',
            ],
            [
                'language_name' => 'Other',
            ],
        ]);
    }
}
