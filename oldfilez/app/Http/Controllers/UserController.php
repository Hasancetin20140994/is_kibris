<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

	public function loginForm(Request $request){
		return view('user.login');
	}

	public function doLogin(Request $request){

		if ( is_numeric($request->input('login') ) ) {
		    $field = 'phoneNumber';
		} elseif (filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)) {
		    $field = 'email';
		}

	    $request->merge([$field => $request->input('login')]);

	    if (Auth::attempt($request->only($field, 'password')) ) {
		    return redirect('/');
		}else{
			return redirect('/user/login');
		}
	}

	public function registerForm(Request $request){
		return view('user.register');
	}

	public function doRegister(Request $request){



		$this->validate($request, [
	        'name' => 'required',
	        'email' => 'required|email',
	        'phoneNumber' => 'required',
	        'password' =>'required',
	        'type' => 'required',
	        'visible' => 'required|boolean'
	    ]);

	    $validator = Validator::make($request, [
		    'person.*.email' => 'email|unique:users',
		    'person.*.first_name' => 'required_with:person.*.last_name',
		]);




		$userData = new User;

	    $userData->name = $request["name"]; 
	    $userData->email = $request["email"];
	    $userData->phoneNumber = $request["phoneNumber"];
	    $userData->password = bcrypt($request["password"]);
	    $userData->type = $request["type"];
	    $userData->visible = $request["visible"];

	    $userData->save();


	    return redirect('/');

	   

	}




    public function apiRegister(Request $request){

    	$validator = Validator::make($request->all(), [
            'name' => 'required',
	        'email' => 'required|email',
	        'phoneNumber' => 'required|size:11',
	        'password' =>'required',
	        'type' => 'required',
	        'visible' => 'required|boolean'
        ]);
    	
    	if ($validator->fails()) {
            return response()->json($validator->errors(),422 );
        }

	    try{
		    $userData = new User;

		    $userData->name = $request["name"]; 
		    $userData->email = $request["email"];
		    $userData->phoneNumber = $request["phoneNumber"];
		    $userData->password = bcrypt($request["password"]);
		    $userData->type = $request["type"];
		    $userData->visible = $request["visible"];
		   
		    if($userData->save()){
		    	return response()->json([
		    	'message'=>'User Created'
		    	],201);
		    }else{
		    	return response()->json("error",422 );
		    }
		    
	    }
	    catch(Illuminate\Database\QueryException $e){
	    	return response()->json($e,422 );
	    }
    }
}
