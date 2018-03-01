<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompanySeeder::class,
            SeekerSeeder::class,
            JobOpeningSeeder::class,
            ApplicationsSeeder::class,
            SeekerEducationSeeder::class,
            SeekerExperienceSeeder::class
        ]);
    }
}
