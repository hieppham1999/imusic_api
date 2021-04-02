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
                'name' => 'Classical',
            ],
            [
                'name' => 'Country',
            ],
            [
                'name' => 'EDM',
            ],
            [
                'name' => 'Hip-hop',
            ],
            [
                'name' => 'Indie rock',
            ],
            [
                'name' => 'Jazz',
            ],
            [
                'name' => 'K-pop',
            ],
            [
                'name' => 'Metal',
            ],
            [
                'name' => 'Oldies',
            ],
            [
                'name' => 'Pop',
            ],
            [
                'name' => 'Rap',
            ],
            [
                'name' => 'R&B',
            ],
            [
                'name' => 'Rock',
            ],
        ]);
    }
}
