<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\JobOpening;
use App\Skill;
use App\JobSkill;
use Carbon\Carbon;

class JobOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $job_openings = 25;
        
        $skills = Skill::all()->pluck('id')->toArray();
        $job_titles = array('Application Developer','Application Support Analyst','Applications Engineer','Associate Developer','Chief Information Officer (CIO)',
                            'Chief Technology Officer (CTO)','Cloud Architect','Cloud Consultant','Cloud System Engineer','Computer and Information Research Scientist',
                            'Computer and Information Systems Manager','Computer Network Architect','Computer Programmer','Computer Systems Analyst','Computer Systems Manager',
                            'Customer Support Administrator','Customer Support Specialist','Data Center Support Specialist','Director of Technology','Junior Software Engineer',
                            'Network and Computer Systems Administrator','Senior Applications Engineer','Software Engineer','Software Quality Assurance Analyst',
                           'Systems Administrator','Systems Designer','Systems Software Engineer','Technical Support Engineer','Telecommunications Specialist',
                           'Web Administrator','Web Developer','Webmaster','Senior Systems Software Engineer','Senior Programmer Analyst','Software Architect',
                           'Network Architect','.NET Developer','IT Support Manager','Help Desk Technician','Help Desk Specialist','Front End Developer');
        
        $job_types = array('Full Time','Part Time','As Needed');
        $experience = array('Not necessary','1-3 Years','3-5 Years','5-10 Years','10-20 Years');
        
        for($i = 0; $i < $job_openings; $i++)
        {
            $startDate = Carbon::create(2018,1,1,0,0,0); //Oldest Job Opening (2018-01-01 00:00:00.0 UTC (+00:00))
            
            $randomCompany = Company::inRandomOrder()->first();
            
            if($randomCompany->created_at->gt($startDate)) //If company created after startDate, use company created_at
                $startDate = $randomCompany->created_at;

            $ranSalary = $faker->numberBetween(0,120);
            $ranSalary = $ranSalary * 1000;
            if($ranSalary <= 30000) $ranSalary = 0;
            
            $date = $faker->dateTimeBetween($startDate,'now');
            
            $job = JobOpening::create([
                'company_id' => $randomCompany->user_id,
                'title' => $faker->randomElement($job_titles),
                'description' => $faker->text($maxNbChars = 300),
                'openings' => $faker->numberBetween(1,10),
                'salary' => $ranSalary,
                'type' => $faker->randomElement($job_types),
                'education' => $faker->numberBetween(0,4),
                'experience' => $faker->randomElement($experience),
                'created_at' => $date,
                'updated_at' => $date
            ]);
            
            $skills_ids = $faker->shuffle($skills); //Shuffle skill IDs
            $skill_array = array();
            for($x = 0; $x < 5; $x++)
            {
                $record = array(
                    'job_id' => $job->id,
                    'skill_id' => $skills_ids[$x],
                    'rating' => $x+1
                );
                array_push($skill_array,$record);
            }
            JobSkill::insert($skill_array);
        }
    }
}
