<?php

namespace Database\Seeders;

use App\Models\LeaveCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'Cuti Tahunan',
                true,
                false,
                false
            ],
            [
                'Cuti Separuh Hari',
                false,
                true,
                false
            ],
            [
                'MC',
                true,
                false,
                false
            ]
        ];

        foreach ($data as $d) {
            $m = new LeaveCategory();
            $m->name = $d[0];
            $m->is_full_day = $d[1];
            $m->is_half_day = $d[2];
            $m->is_mc = $d[3];
            $m->save();
        }
    }
}
