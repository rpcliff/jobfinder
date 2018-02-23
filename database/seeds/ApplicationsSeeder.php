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
        
        $num_applications = 10;
        
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

        for($i = 0; $i < $num_applications; $i++)
        {
            $ran = $faker->numberBetween(0,count($jobSeekerCombos));

            $seekerID = $jobSeekerCombos[$ran][0];
            $jobID = $jobSeekerCombos[$ran][1];
            unset($jobSeekerCombos[$ran]);

            $job = JobOpening::where('id',$jobID)->first();

            $application = Application::create([
                'seeker_id' => $seekerID,
                'job_id' => $jobID,
                'created_at' => $faker->dateTimeBetween($job->created_at,'now'),
                'updated_at' => $faker->dateTimeBetween($job->created_at,'now')
            ]);
        }
    }
}
