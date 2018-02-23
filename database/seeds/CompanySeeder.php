<?php

use Illuminate\Database\Seeder;


use App\User;
use App\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $companies = array(
            array('Apple','',''),
            array('Amazon','',''),
            array('Dell', '', ''),
            array('Digital Ocean', '', ''),
            array('Discord', '', ''),
            array('Ebay', '', ''),
            array('Facebook', '', ''),
            array('Google', '', ''),
            array('Instagram', '', ''),
            array('Microsoft', '', ''),
            array('Nvidia', '', ''),
            array('Paypal', '', ''),
            array('Samsung', '', ''),
            array('Skype', '', ''),
            array('SoundCloud', '', ''),
            array('Twitter', '', '')
        );
        
        $startDate = '2015-01-01 00:00:00';
        
        for($i = 0; $i < count($companies); $i++)
        {
            $email = trim($companies[$i][1]);
            if(empty($email))
            {
                $comp_name = str_replace(' ','_',$companies[$i][0]);
                $email = "cs@".strtolower($comp_name).".com";
            }
            
            $user = User::create([
               'email' => $email,
                'user_type' => 2,
                'password' => bcrypt('asdf'),
                'created_at' => $faker->dateTimeBetween($startDate,'now'),
                'updated_at' => $faker->dateTimeBetween($startDate,'now')
            ]);
            
            $description = trim($companies[$i][2]);
            if(empty($description))
                $description = $faker->text($maxNbChars = 500);
            
            $company = Company::create([
                'user_id' => $user->id,
                'name' => $companies[$i][0],
                'description' => $description,
                'phone' => $faker->numerify('##########'),
                'city' => $faker->city,
                'state' => $faker->state,
                'zipcode' => $faker->numerify('#####'),
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ]);
        }
    }
}
