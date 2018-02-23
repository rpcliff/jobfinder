<?php

use Illuminate\Database\Seeder;
use App\Seeker;
use App\User;
use App\Skill;
use App\SeekerSkill;

class SeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $skills = App\Skill::all()->pluck('id')->toArray();
        
        $startDate = '2015-01-01 00:00:00';
        
        $num_seekers = 40;
        
        for($i = 0; $i < $num_seekers; $i++)
        {
            $first_name = $faker->firstName;
            $last_name = $faker->lastName;
            
            //Email format: firstname.lastname@domain.com
            $email = strtolower($first_name).'.'.strtolower($last_name).$faker->freeEmailDomain;

            $user = User::create([
               'email' => $email,
                'user_type' => 1,
                'password' => bcrypt('asdf'),
                'created_at' => $faker->dateTimeBetween($startDate,'now'),
                'updated_at' => $faker->dateTimeBetween($startDate,'now')
            ]);
            
            $seeker = Seeker::create([
                'user_id' => $user->id,
                'name' => $first_name.' '.$last_name,
                'phone' => $faker->numerify('###-###-####'),
                'city' => $faker->city,
                'state' => $faker->state,
                'zipcode' => $faker->numerify('#####')
            ]);
            
            $skills_ids = $faker->shuffle($skills); //Shuffle skill IDs
            $skill_array = array();
            for($x = 0; $x < 10; $x++)
            {
                $record = array(
                    'seeker_id' => $user->id,
                    'skill_id' => $skills_ids[$x],
                    'rating' => $x+1
                );
                array_push($skill_array,$record);
            }
            SeekerSkill::insert($skill_array);
        }
    }
}
