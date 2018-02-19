<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeekerEducation extends Model
{
    public function seeker()
    {
        return $this->belongsTo(Seeker::class, 'seeker_id', 'user_id');
    }
}
