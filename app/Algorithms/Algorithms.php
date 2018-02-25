<?php

function getSuggestedJobs($seeker_id)
{
    $jobs = \App\JobOpening::all();
    $seeker = \App\Seeker::find($seeker_id);
    
    $suggested = array();
    foreach($jobs as $job)
    {
        $total_points = 0;
        foreach($job->job_skills as $job_skill)
        {
            $matched_skill = false;
            $job_level = 6-($job_skill->rating);
            foreach($seeker->seeker_skills as $seeker_skill)
            {
                if($job_skill->skill_id == $seeker_skill->skill_id)
                {
                    $matched_skill = true;
                    //echo "Skill - ".$job_skill->skill_id;
                    //echo ", Job Rating - ".$job_skill->rating;
                    //echo ", Job Level - ".$job_level;
                    $seeker_level = round((11-($seeker_skill->rating))/2,1);
                    //echo ", Seeker Rating - ".$seeker_skill->rating;
                    //echo ", Seeker Level - ".$seeker_level;
                    $diff = $job_level - $seeker_level;
                    //echo ", Diff: ".$diff;
                    if($diff > 0)
                        $total_points = $total_points + $diff;
                    
                    //echo ", Total Points: ".$total_points."<br>";
                    
                    break;
                }
            }
            if(!$matched_skill)
            {
                //echo "NOT MATCHED<br>";
                $total_points = $total_points + $job_level;
            }
            
        }

        //Best is 0, Worst is 15
        $percentage = round((((15-$total_points)/15.0))*100,2);
        $suggested[$job->id] = $percentage;
        
    }

    arsort($suggested);
    
    return $suggested;
}

function getSortedApplicants($job_id)
{
    $jobs = \App\JobOpening::where('id',$job_id)->first();
    $job_skills = $jobs->job_skills;

    $applications = \App\Application::where('job_id',$job_id)->get();
    
    $applicants = array();
    
    foreach($applications as $application)
    {
        $total_points = 0;
        $seeker_skills = \App\SeekerSkill::where('seeker_id',$application->seeker->user_id)->orderBy('skill_id')->get(); //ASCENDING
        //echo "<br>Checking Seeker: ".$application->seeker->user_id."<br>";
        $match = getSkillsMatch($job_skills, $seeker_skills);
        
        $applicants[$application->id] = $match;
    }
    arsort($applicants);
    //dd($applicants);
    return $applicants;
}

function getSkillsMatch($job_skills, $seeker_skills)
{
    $points = 0;
    $total_matches = 0;
    foreach($job_skills as $job_skill)
    {
        $j_pts = 6-$job_skill->rating;
        //echo "Job Skill Rating: ".$job_skill->rating."<br>";
        //echo "Job Skill Points: ".$j_pts."<br>";
        //echo "Looking for Skill ID: ".$job_skill->skill_id."<br>";
        $rating = findSeekerSkillRating($job_skill->skill_id, $seeker_skills);
        
        if($rating == -1) //NOT FOUND
        {
            //echo "<strong>Skill Not Found</strong> <br>";
        }
        else
        {
            $total_matches++;
            $s_pts = (11-$rating)/2;
            //echo "Seeker Points: ".$s_pts."<br>";
            if($j_pts >= $s_pts)
            {
                $diff = $j_pts - $s_pts;
                $points = $points + ($j_pts - $diff);
            }
            else
            {
                $points = $points + $j_pts;
            }
        }
        
        //echo "Total Points: ".$points."<br>";
    }
    $percentage = round(((($points)/15.0))*100,2);
    //echo "Percentage found: ".$percentage."<br><br>";

    return array($percentage,$total_matches);
}

function findSeekerSkillRating($skill_id, $seeker_skills)
{
    $left = 0;
    $right = count($seeker_skills)-1;
    while($left <= $right)
    {
        $mid = round($left + ($right - $left)/2);

        if($seeker_skills[$mid]->skill_id == $skill_id)
        {
            $rating = $seeker_skills[$mid]->rating;

            return $seeker_skills[$mid]->rating;
        }

        if($seeker_skills[$mid]->skill_id > $skill_id)
            $right = $mid - 1;
        else
            $left = $mid + 1;
    }
    return -1;
}