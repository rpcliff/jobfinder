<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = 'user_id';
    
    //protected $fillable = [
    //    'name', 
    //];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function job_openings()
    {
        //Has Many JobOpenings with foreign key 'company_id' to match with Company 'user_id'
        return $this->hasMany(JobOpening::class, 'company_id', 'user_id');
    }
}
