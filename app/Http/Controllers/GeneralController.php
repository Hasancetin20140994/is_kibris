<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs;
use App\Category;
use App\City;
use App\Type;
use App\Education;

class GeneralController extends Controller
{

	public function apiGetAllGeneralFields(Request $request){
		$jobParameters = array();

        $jobParameters["categories"] = Category::with("childrenRecursive")->whereNull("parent_id")->orderBy('name', 'asc')->get();
        $jobParameters["cities"] = City::orderBy('name', 'asc')->get();
        $jobParameters["types"] = Type::orderBy('name', 'asc')->get();
		$jobParameters["education"] = Education::orderBy('id', 'asc')->get();
        return response()->json($jobParameters);
	}

}
