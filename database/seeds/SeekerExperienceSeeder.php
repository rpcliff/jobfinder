<?php

use Illuminate\Database\Seeder;
use App\Seeker;
use App\SeekerExperience;

class SeekerExperienceSeeder extends Seeder
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
            $ranExperiences = $faker->numberBetween(0,4);
            $dates_array = array();
            $endDates_array = array();
            $date1 = $faker->date('Y-m-d','-90 days');
            array_push($dates_array,$date1);
            for($x = 1; $x < $ranExperiences; $x++)
            {
                $prev_date = $dates_array[$x-1];
                
                if($x == 1) $endDate = '-60 days';
                else if($x == 2) $endDate = '-30 days';
                else if($x == 3) $endDate = '-15 days';
                else $endDate = '-5 days';
                
                $next_date = $faker->dateTimeBetween($prev_date,$endDate)->format('Y-m-d');
                
                $prev_end_date = $faker->dateTimeBetween($prev_date,$next_date)->format('Y-m-d');
                array_push($endDates_array,$prev_end_date);
                array_push($dates_array,$next_date);
            }
            $last_end_date = $faker->dateTimeBetween($dates_array[count($dates_array)-1],'now')->format('Y-m-d');
            array_push($endDates_array,$last_end_date);
            
            for($i = 0; $i < $ranExperiences; $i++)
            {
                $date = $faker->dateTimeBetween($seeker->created_at,'now');
                
                $started = $dates_array[$i];
                $ended = $endDates_array[$i];
                
                $date_end = new \DateTime($ended);
                $date_start = new \DateTime($started);

                //Get Experience in days
                $interval = $date_start->diff($date_end);
                $days_experience = $interval->format('%a');
                
                $experience = SeekerExperience::create([
                    'seeker_id' => $seeker->user_id,
                    'company' => $faker->company,
                    'job_title' => $faker->jobTitle,
                    'started' => $started,
                    'ended' => $ended,
                    'present' => 0,
                    'description' => $faker->text(300),
                    'days_experience' => $days_experience,
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
            }
        }
    }
}
