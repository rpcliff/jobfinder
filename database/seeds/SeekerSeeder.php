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
        
        $num_seekers = 90;
        
        //Fill array with all PNG files in said directory and shuffle
        $directory = 'public/storage/seeker_images/people_portraits/';
        $images = array_merge(glob($directory.'*.png'),glob($directory.'*.jpg'));
        shuffle($images);

        for($i = 0; $i < $num_seekers; $i++)
        {
            if(count($images)>0)
            {
                $image = array_shift($images);
                $filename = basename($image);
                $male = (substr($filename,0,1)=='m')?true:false;
                if($male)
                    $first_name = $faker->firstNameMale;
                else
                    $first_name = $faker->firstNameFemale;
            }
            else
                $first_name = $faker->firstName;

            $last_name = $faker->lastName;
            
            //Email format: firstname.lastname@domain.com
            $email = strtolower($first_name).'.'.strtolower($last_name).'@'.$faker->freeEmailDomain;

            $join_date = $faker->dateTimeBetween($startDate,'now');
            
            $user = User::create([
               'email' => $email,
                'user_type' => 1,
                'password' => bcrypt('asdf'),
                'created_at' => $join_date,
                'updated_at' => $join_date
            ]);
            
            $seeker = Seeker::create([
                'user_id' => $user->id,
                'name' => $first_name.' '.$last_name,
                'phone' => $faker->numerify('###-###-####'),
                'city' => $faker->city,
                'state' => $faker->state,
                'zipcode' => $faker->numerify('#####'),
                'age' => $faker->numberBetween(18,60),
                'created_at' => $join_date,
                'updated_at' => $join_date
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
            
            //If images left, copy one over and rename
            if(count($images)>0)
            {
                $newPath = 'public/storage/seeker_images/seeker'.$user->id.'.png';
                $copied = copy($image,$newPath);
            }
        }
    }
}
