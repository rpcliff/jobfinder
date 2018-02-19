<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            'name' => 'Java Programming',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'C# Programming',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Javascript Programming',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Database Development',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Public Speaking',
            'category' => 'Business'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Cryptography',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Networking',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Documentation',
            'category' => 'Business'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Algorithms',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Operating Systems',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Compiler Design',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Network Security',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'System Analysis',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Debugging',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Unit Testing',
            'category' => 'Technology'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Quality Control',
            'category' => 'Management'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Task Delegation',
            'category' => 'Management'
        ]);
        
        DB::table('skills')->insert([
            'name' => 'Task Management',
            'category' => 'Management'
        ]);
    }
}
