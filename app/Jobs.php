<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

	public function education(){
    	return $this->belongsTo(Education::class);
    }

	public function company()
    {
    	return $this->belongsTo(Company::class);
    }

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

}


