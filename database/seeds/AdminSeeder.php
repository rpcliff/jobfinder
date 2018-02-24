<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'user_type' => 3,
            'password' => bcrypt('admin'),
            'created_at' => $faker->dateTime('now'),
            'updated_at' => $faker->dateTime('now')
        ]);
    }
}
