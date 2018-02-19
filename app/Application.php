<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function seeker()
    {
        return $this->belongsTo(Seeker::class, 'seeker_id', 'user_id');
    }
    
    public function job()
    {
        return $this->belongsTo(JobOpening::class, 'job_id', 'id');
    }
}
