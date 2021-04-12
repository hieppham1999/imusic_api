<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('genres')->insert([
            [
                'genre_name' => 'Classical',
            ],
            [
                'genre_name' => 'Country',
            ],
            [
                'genre_name' => 'EDM',
            ],
            [
                'genre_name' => 'Hip-hop',
            ],
            [
                'genre_name' => 'Indie rock',
            ],
            [
                'genre_name' => 'Jazz',
            ],
            [
                'genre_name' => 'Folk',
            ],
            [
                'genre_name' => 'Metal',
            ],
            [
                'genre_name' => 'Oldies',
            ],
            [
                'genre_name' => 'Pop',
            ],
            [
                'genre_name' => 'Rap',
            ],
            [
                'genre_name' => 'R&B',
            ],
            [
                'genre_name' => 'Rock',
            ],
        ]);
    }
}
