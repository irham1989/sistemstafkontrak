<?php

namespace Database\Seeders;

use App\Models\AcademicQualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicQualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'SPM & Setaraf',
            'Diploma & Setaraf',
            'Sarjana Muda',
            'Sarjana',
            'PHD'
        ];

        foreach ($data as $d) {
            $m = new AcademicQualification();
            $m->name = $d;
            $m->save();
        }
    }
}
