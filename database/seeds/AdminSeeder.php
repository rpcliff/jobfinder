<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Admin;

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
        /*
        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'user_type' => 3,
            'password' => bcrypt('admin'),
            'created_at' => $faker->dateTime('now'),
            'updated_at' => $faker->dateTime('now')
        ]);*/
        
        $admin = User::create([
            'email' => 'admin@admin.com',
            'user_type' => 3,
            'password' => bcrypt('asdf'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        Admin::create([
            'user_id' => $admin->id,
            'name' => 'Master',
            'priviledges' => 0
        ]);
    }
}
