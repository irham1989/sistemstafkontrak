<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Islam',
                false
            ],
            [
                'Buddha',
                false
            ],
            [
                'Hindu',
                false
            ],
            [
                'Lain - Lain',
                true
            ]
        ];

        foreach($data as $race) {
            $r = new Religion();
            $r->name = $race[0];
            $r->other_flag = $race[1];
            $r->save();
        }
    }
}
