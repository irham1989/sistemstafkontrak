<?php

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Malay',
                false
            ],
            [
                'Chinese',
                false
            ],
            [
                'Indian',
                false
            ],
            [
                'Lain - Lain',
                true
            ]
        ];

        foreach($data as $race) {
            $r = new Race();
            $r->name = $race[0];
            $r->other_flag = $race[1];
            $r->save();
        }
    }
}
