<?php

namespace Database\Seeders;

use App\Models\Bumiputera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BumiputeraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Bumiputera',
                false
            ],
            [
                'Bukan Bumiputera',
                false
            ],
            [
                'Lain-Lain',
                true
            ]
        ];

        foreach ($data as $d) {
            $m = new Bumiputera();
            $m->name = $d[0];
            $m->other_flag = $d[1];
            $m->save();
        }
    }
}
