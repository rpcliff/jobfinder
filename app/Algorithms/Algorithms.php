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