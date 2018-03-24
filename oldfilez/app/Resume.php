<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    public function category()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function city()
    {
    	return $this->belongsToMany(City::class);
    }

    public function type()
    {
    	return $this->belongsToMany(Type::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }
}
