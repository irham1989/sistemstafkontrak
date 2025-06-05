<?php

namespace Database\Seeders;

use App\Models\LeaveRequestStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveRequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Menunggu Pengesahan Permohonan',
            'Permohonan Cuti Diluluskan',
            'Permohonan Cuti Tidak Lulus',
        ];

        foreach ($data as $d) {
            $m = new LeaveRequestStatus();
            $m->name = $d;
            $m->save();
        }
    }
}
