<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'ketua_unit',
                'display_name' => 'Ketua Unit',
            ],
            [
                'name' => 'penolong_pengarah',
                'display_name' => 'Penolong Pengarah',
            ],
            [
                'name' => 'ketua_pengarah',
                'display_name' => 'Ketua Pengarah',
            ],
        ];

        foreach ($data as $datum) {
            $m = new Role();
            $m->name = $datum['name'];
            $m->display_name = $datum['display_name'];
            $m->save();
        }
    }
}
