<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function jobs(){
    	return $this->belongsToMany(Jobs::class);
    }
}
