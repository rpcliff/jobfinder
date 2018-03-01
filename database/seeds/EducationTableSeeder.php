<?php

use Illuminate\Database\Seeder;

use App\Education;

class EducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = array('Associates Degree', 'Bachelors Degree', 'Masters Degree', 'Doctoral Degree');
        
        for($i = 0; $i < count($educations); $i++)
        {
            $education = Education::create([
               'education' => $educations[$i],
            ]);
        }
    }
}
