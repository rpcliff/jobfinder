<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeekerSkill extends Model
{
    protected $primaryKey = 'seeker_id';
    public $timestamps = false;
    
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
    
    public function seeker()
    {
        //Belongs To a Seeker with PrimaryKey 'user_id' match with foreign key 'seeker_id'
        return $this->belongsTo(Seeker::class, 'seeker_id', 'user_id');
    }
}
