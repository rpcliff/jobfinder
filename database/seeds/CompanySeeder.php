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
            //Format(NAME,EMAIL,DESCRIPTION,)
            array('Apple','','',''),
            array('Amazon','','',''),
            array('Dell', '', '',''),
            array('Digital Ocean', '', '',''),
            array('Discord', '', '',''),
            array('Ebay', '', '',''),
            array('Facebook', '', '',''),
            array('Google', '', '',''),
            array('Instagram', '', '',''),
            array('Microsoft', '', '',''),
            array('Nvidia', '', '',''),
            array('Paypal', '', '',''),
            array('Samsung', '', '',''),
            array('Skype', '', ''),
            array('SoundCloud', '', '',''),
            array('Twitter', '', '','')
        );
        
        $industries = array('Basic Industries','Capital Goods','Consumer Durables','Consumer Non-Durables','Consumer Services','Energy','Finance','Healthcare','Miscellaneous','Public Utilities','Technology','Transportation');
        
        $startDate = '2015-01-01 00:00:00';
        
        for($i = 0; $i < count($companies); $i++)
        {
            $email = trim($companies[$i][1]);
            if(empty($email))
            {
                $comp_name = str_replace(' ','_',$companies[$i][0]);
                $email = "cs@".strtolower($comp_name).".com";
            }
            
            $join_date = $faker->dateTimeBetween($startDate,'now');
            
            $user = User::create([
               'email' => $email,
                'user_type' => 2,
                'password' => bcrypt('asdf'),
                'created_at' => $join_date,
                'updated_at' => $join_date
            ]);
            
            $description = trim($companies[$i][2]);
            if(empty($description))
                $description = $faker->text($maxNbChars = 500);
            
            $company = Company::create([
                'user_id' => $user->id,
                'name' => $companies[$i][0],
                'industry' => $faker->randomElement($industries),
                'description' => $description,
                'phone' => $faker->numerify('###-###-####'),
                'founded' => $faker->year('now'),
                'size' => $faker->numberBetween(1,10000),
                'city' => $faker->city,
                'state' => $faker->state,
                'zipcode' => $faker->numerify('#####'),
                'website' => 'http://'.$faker->domainName,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ]);
        }
    }
}
