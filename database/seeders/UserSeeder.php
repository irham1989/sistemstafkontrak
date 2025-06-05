<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super-admin',
                'display_name' => 'Super Admin'
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin'
            ],
            [
                'name' => 'approval-admin',
                'display_name' => 'Pegawai Pengesahan'
            ],
            [
                'name' => 'staff',
                'display_name' => 'Staf'
            ],
        ];

        foreach ($roles as $role) {
            $r = new Role();
            $r->name = $role['name'];
            $r->display_name = $role['display_name'];
            $r->save();
        }

        $superadmin = new User();
        $superadmin->name = 'Super Admin';
        $superadmin->ic_no = 1111;
        $superadmin->email = 'superadmin@mail.com';
        $superadmin->password = Hash::make('password');
        $superadmin->save();
        $superadmin->syncRoles(['super-admin']);

        $superadmin = new User();
        $superadmin->name = 'Admin';
        $superadmin->ic_no = 2222;
        $superadmin->email = 'admin@mail.com';
        $superadmin->password = Hash::make('password');
        $superadmin->save();
        $superadmin->syncRoles(['admin']);

        $superadmin = new User();
        $superadmin->name = 'Pegawai Pengesahan';
        $superadmin->ic_no = 4444;
        $superadmin->email = 'approval@mail.com';
        $superadmin->password = Hash::make('password');
        $superadmin->save();
        $superadmin->syncRoles(['approval-admin']);
    }
}
