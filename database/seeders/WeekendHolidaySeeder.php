<?php

namespace Database\Seeders;

use App\Models\WeekendHoliday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekendHolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [14, 6, 0],
            [14, 7, 0],
            [12, 6, 0],
            [12, 7, 0],
            [9, 6, 0],
            [9, 7, 0],
            [1, 6, 0],
            [1, 7, 0],
            [7, 6, 0],
            [7, 7, 0],
            [10, 6, 0],
            [10, 7, 0],
            [11, 6, 0],
            [11, 7, 0],
            [2, 5, 0],
            [2, 6, 0],
            [3, 6, 0],
            [3, 7, 0],
            [13, 6, 0],
            [13, 5, 0],
            [4, 6, 0],
            [4, 7, 0],
            [5, 6, 0],
            [5, 7, 0],
            [6, 6, 0],
            [6, 7, 0],
            [8, 6, 0],
            [8, 7, 0],
            [15, 6, 0],
            [15, 7, 0],
            [16, 6, 0],
            [16, 7, 0]
        ];

        foreach($data as $d){
            $m  = new WeekendHoliday();
            $m->state_id = $d[0];
            $m->day_id = $d[1];
            $m->deleted = $d[2];
            $m->save();
        }
    }
}
