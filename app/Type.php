<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function jobs(){
    	return $this->belongsToMany(Jobs::class);
    }
}
