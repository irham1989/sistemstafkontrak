<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Berkahwin',
            'Bujang',
            'Duda',
            'Janda/Balu'
        ];

        foreach ($data as $d) {
            $m = new MaritalStatus();
            $m->name = $d;
            $m->save();
        }
    }
}
