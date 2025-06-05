<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Monday',
                'Isnin'
            ],
            [
                'Tuesday',
                'Selasa'
            ],
            [
                'Wednesday',
                'Rabu'
            ],
            [
                'Thursday',
                'Khamis'
            ],
            [
                'Friday',
                'Jumaat'
            ],
            [
                'Saturday',
                'Sabtu'
            ],
            [
                'Sunday',
                'Ahad'
            ]
        ];

        foreach ($data as $day) {
            $m = new Day();
            $m->name = $day[0];
            $m->display_name = $day[1];
            $m->save();
        }
    }
}
