<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{


    public function apiUserCompany(Request $request){
        $user = $request->user();
        $user->company;

        $returnData["user"] = $user;

        if(isAjax()) // This is what i am needing.
        {
          return response()->json($returnData);
        }else{
            return view('companies.index', compact('returnData'));
        }


        

    }

    public function apiEditUserCompany(Request $request){
        $user = $request->user();


        if($user->company != null){
        	$company = $user->company;
        }else{
        	$company = new Company;
        }
        $company->name =  $request->userCompany["name"];
        $company->email =  $request->userCompany["email"];
        $company->phone =  $request->userCompany["phone"];
        $company->website =  $request->userCompany["website"];
        $company->about = $request->userCompany["about"];
        $company->user_id = $user->id;
        $company->logo = "";
        
        $company->save();

  

        return response()->json("OK");
    }
}
