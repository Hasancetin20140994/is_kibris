<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function jobs(){
    	return $this->belongsToMany(Jobs::class);
    }
	
	public function resumes(){
    	return $this->belongsToMany(Resume::class);
    }
}
