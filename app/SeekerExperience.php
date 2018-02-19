<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeekerExperience extends Model
{
    public function seeker()
    {
        return $this->belongsTo(Seeker::class, 'seeker_id', 'user_id');
    }
}
