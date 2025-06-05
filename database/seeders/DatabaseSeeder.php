<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            AcademicQualificationSeeder::class,
            BumiputeraSeeder::class,
            CountrySeeder::class,
            GenderSeeder::class,
            MaritalStatusSeeder::class,
            RacesSeeder::class,
            ReligionSeeder::class,
            SalutationSeeder::class,
            UserSeeder::class,
            NewRoleSeeder::class,
            DaySeeder::class,
            WeekendHolidaySeeder::class,
            LeaveCategorySeeder::class,
            LeaveRequestStatusSeeder::class,
        ]);
    }
}
