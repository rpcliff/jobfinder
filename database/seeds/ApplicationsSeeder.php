<?php

use Illuminate\Database\Seeder;
use App\Seeker;
use App\Application;
use App\JobOpening;

class ApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $num_applications = 90;
        
        $seekerIDs = Seeker::all()->pluck('user_id')->toArray();
        $jobIDs = JobOpening::all()->pluck('id')->toArray();
        $jobSeekerCombos = array();
        for($i = 0; $i < count($seekerIDs); $i++)
        {
            for($x = 0; $x < count($jobIDs); $x++)
            {
                array_push($jobSeekerCombos,array($seekerIDs[$i],$jobIDs[$x]));
            }
        }
        
        shuffle($jobSeekerCombos);

        for($i = 0; $i < $num_applications; $i++)
        {
            $combo = array_shift($jobSeekerCombos);
            $seekerID = $combo[0];
            $jobID = $combo[1];

            $job = JobOpening::where('id',$jobID)->first();

            $apply_date = $faker->dateTimeBetween($job->created_at,'now');
            
            $application = Application::create([
                'seeker_id' => $seekerID,
                'job_id' => $jobID,
                'created_at' => $apply_date,
                'updated_at' => $apply_date
            ]);
        }
    }
}
