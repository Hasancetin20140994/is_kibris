<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs;
use App\Category;
use App\City;
use App\Type;

class GeneralController extends Controller
{

	public function apiGetAllGeneralFields(Request $request){
		$jobParameters = array();

        $jobParameters["categories"] = Category::orderBy('name', 'asc')->get();
        $jobParameters["cities"] = City::orderBy('name', 'asc')->get();
        $jobParameters["types"] = Type::orderBy('name', 'asc')->get();
        return response()->json($jobParameters);
	}

}
