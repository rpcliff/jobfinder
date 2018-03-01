<?php

use Illuminate\Database\Seeder;
use App\SeekerEducation;
use App\Seeker;

class SeekerEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $universities = array('Columbia University','Harvard University','Yale University','University of Michigan','Stanford University','DePaul University',
                             'University of Virginia','University of Pennsylvania','Texas A&M University','University of California, Berkeley','Ohio State University',
                             'Cornell University','University of Minnesota','Pennsylvania State University','Duke University','Princeton University','University of North Carolina',
                             'Purdue University','University of Florida','University of Chicago','Brown University','Northwestern University','University of Southern California');
        
        $degrees = array('Aeronautical Engineering','Civil Engineering','Computer Science','Computer Engineering','Chemical Engineering','Electrical Engineering',
                        'Biomedical Engineering','Environmental Engineering','Mechanical Engineering','Mathematics','Information Technology','Telecommunications',
                        'Software Engineering','Robotics','Architecture','Biotechnology','Biology','Biochemistry','Business','Geology','Oceanography','Chemistry');
        
        $seekers = Seeker::all();

        foreach($seekers as $seeker)
        {
            $ranEducations = $faker->numberBetween(0,3);
            for($i = 0; $i < $ranEducations; $i++)
            {
                $education_type = $faker->numberBetween(1,4);
                $date = $faker->dateTimeBetween($seeker->created_at,'now');
                
                $education = SeekerEducation::create([
                    'seeker_id' => $seeker->user_id,
                    'university' => $faker->randomElement($universities),
                    'education_id' => $education_type,
                    'title' => $faker->randomElement($degrees),
                    'achieved' => $faker->date('Y-m-d','now'),
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
            }
        }
    }
}
