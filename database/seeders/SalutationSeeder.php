<?php

namespace Database\Seeders;

use App\Models\Salutation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalutationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Encik',
            'Puan',
            'Cik',
            'Dato`',
            'Datuk'
        ];

        foreach ($data as $value) {
            $m = new Salutation();
            $m->name = $value;
            $m->save();
        }
    }
}
