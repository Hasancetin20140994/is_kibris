<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


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
		
		if(DB::table('users')->where('email', $request["email"])->count()){
			return response()->json("E-mail adresi daha önceden kullanılmış.",409);
		}
		
		if(DB::table('users')->where('phoneNumber', $request["phoneNumber"])->count()){
			return response()->json("Telefon numarasıdaha önceden kullanılmış.",409);
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

	public function apiDoFBLogin(Request $request)
	{
			

		$stoken = $request->token;
		$fbuser = Socialite::driver('facebook')->userFromToken($stoken);
		$return_data = array();
		
		
		if(DB::table('users')->where('email', $fbuser->email)->count()){
			$user = User::where('email', $fbuser->email)->first();

			$return_data["token"] = $user->createToken('')->accessToken;
			$return_data["first_time"] = false;
			return response()->json($return_data);
		}else{
			$userData = new User;
		    $userData->name = $fbuser->name; 
		    $userData->email = $fbuser->email;
		    $userData->phoneNumber = "";
		    $userData->password = bcrypt(str_random(8));
		    $userData->type = "candidate";
		    $userData->visible = 1;
		    $userData->login_type= "facebook";
			
			if($userData->save()){
		    	$user = User::where('email', $fbuser->email)->first();
				$token = $user->createToken('')->accessToken;
				$return_data["token"] = $token; 
				$return_data["first_time"] = true; 
				return response()->json($return_data);
		    }else{
		    	return response()->json("error",422 );
		    }
		}
		
		
		return response()->json($user);
	}

	public function saveIonicToken(Request $request){
		$user = $request->user();
		
		$token = DB::table('user_ic_tokens')->where('user_id', $user->id)->where('token', $request->token)->get();
		
		
		if(count($token)==0){
			DB::table('user_ic_tokens')->insert(	
				['user_id' => $user->id, 'token' => $request->token]
			);	
			
			return response()->json('Token Saved',201);
		}else{
			return response()->json('Token Exist',201);
		}
		
		

		

	}
	
	public function uploadImage(Request $request){

		$user = $request->user();
		
		if( isset($request->image64) &&  strlen($request->image64) > 0 ){
			$baseFromJavascript = urldecode($request->image64);
			$base_to_php = explode(',', $baseFromJavascript);
			$data = base64_decode($base_to_php[1],false );
			
			$filename = "isk_".uniqid().".jpg";
			
			$filepath = public_path("uploads/profilephotos/".$filename); // or image.jpg
			
			if(file_put_contents($filepath,$data)){
					
				
				if( isset( $user->image_path ) ){
					$urlarray = parse_url($user->image_path);
					unlink( public_path($urlarray["path"] ) );
				}
				
				
				$user->image_path = url("uploads/profilephotos/".$filename);
				$user->save();
				
				return response("success",201);
			}else{
				return response("error",500);
			}			
		}else{
			return response("error",500);
		}

	}

	public function removeUploadImage(Request $request){
		
		 
		$user = $request->user();
		
		if( isset( $user->image_path ) ){
			$urlarray = parse_url($user->image_path);
			unlink( public_path($urlarray["path"] ) );
			$user->image_path = '';
			$user->save();
			return response("ok",201);
		}else{
			return response("error",500);
		}

	}

}
