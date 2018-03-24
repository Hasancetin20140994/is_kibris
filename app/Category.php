<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function jobs(){
    	return $this->belongsToMany(Jobs::class);
    }

    public function children()
	{
	   return $this->hasMany('App\Category', 'parent_id');
	}

	// recursive, loads all descendants
	public function childrenRecursive()
	{
	   return $this->children()->with('childrenRecursive');
	   // which is equivalent to:
	   // return $this->hasMany('Survey', 'parent')->with('childrenRecursive);
	}

	// parent
	public function parent()
	{
	   return $this->belongsTo('App\Category','parent_id');
	}

	// all ascendants
	public function parentRecursive()
	{
	   return $this->parent()->with('parentRecursive');
	}
}
