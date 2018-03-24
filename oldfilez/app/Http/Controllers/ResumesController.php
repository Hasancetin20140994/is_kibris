<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Resume;
use App\Category;
use App\City;
use App\Type;

class ResumesController extends Controller
{
     public function index(Request $request){
    	$resumes = Resume::all();
    	return view('resumes.index', ['resumes' => $resumes]);
    }

    public function create(Request $request){
        $resumeParameters = array();

        $resumeParameters["categories"] = Category::orderBy('name', 'asc')->pluck("name","id");
        $resumeParameters["cities"] = City::orderBy('name', 'asc')->pluck("name","id");
        $resumeParameters["types"] = Type::orderBy('name', 'asc')->pluck("name","id");
    	return view('resumes.create',['resumeParameters' => $resumeParameters]);
    }

    public function store(Request $request){
    	if (Auth::check()){

			$resume = new Resume;

			$now = Carbon::now(); 

			$resume->body = $request->body;
			$resume->education = $request->education;
			$resume->nationality = $request->nationality;
			$resume->workPermit = $request->nationality;;
			$resume->user_id = $id = Auth::user()->id;
			$resume->save();

	        $resume->category()->attach($request->category);
	        $resume->city()->attach($request->city);
        
        }else{
    		dd("Kullanıcı Giriş Yapmamış");
    	}
    }

    public function show(Request $request,$id){
    	$resume = Resume::with("category")->find($id);
    	
        return view('resumes.show', ['resume' => $resume]);	
    }

    public function edit(Request $request,$id){
    	$resume = Resume::where('id',$id)->first();
    	return view('resumes.edit', ['job' => $resume]);
    }

    public function update(Request $request,$id){
    	$resume = Resume::where('id',$id)->first();


		$resume->name = $request->name;
		$resume->body = $request->body;
		$resume->phone = $request->phone;
		$resume->email = $request->email;
		$resume->save();
		
    }

    public function destroy(Request $request,$id){
    	$resume = Resume::where('id',$id)->first();


    	$resume->delete();
    }

    /*Api Controller*/
    

    public function apiIndex(Request $request){
    	$jobs = Resume::all();
    	return response()->json($jobs);
    }

    public function apiShow(Request $request,$id){
    	$resume = Resume::with("category")->find($id);
        return response()->json($resume);
    }

    public function apiCreate(Request $request){
        $resumeParameters = array();

        $resumeParameters["categories"] = Category::orderBy('name', 'asc')->pluck("name","id");
        $resumeParameters["categories"] = Category::orderBy('name', 'asc')->pluck("name","id");
        $resumeParameters["cities"] = City::orderBy('name', 'asc')->pluck("name","id");
        $resumeParameters["types"] = Type::orderBy('name', 'asc')->pluck("name","id");
        return response()->json($resumeParameters);
    }

    public function apiStore(Request $request){
        $resume = new Resume;

        $now = Carbon::now(); 

        $resume->name = $request->name;
        $resume->body = $request->body;
        $resume->phone = $request->phoneNumber;
        $resume->email = $request->email;
        $resume->isFeatured = 0;
        $resume->user_id = 1;
        $resume->company_id = 1;
        $resume->startDate = $now->format('Y-m-d H:i:s');
        $resume->endDate = $now->addMonths(1)->format('Y-m-d H:i:s');

        
        $resume->save();
        $resume->category()->attach($request->category);
        return response()->json($resume->id);
    }

    public function apiUpdate(Request $request){

    }

    public function apiDestroy(Request $request){

    }

    public function apiUserResume(Request $request){
        $user = $request->user();
        $user->resume;
        if($user->resume != null){
            $user->resume->category;
            $user->resume->city;    
        }
        

        $returnData["user"] = $user;

        $returnData["categories"] = Category::orderBy('name', 'asc')->pluck("name","id");
        $returnData["cities"] = City::orderBy('name', 'asc')->pluck("name","id");
        $returnData["types"] = Type::orderBy('name', 'asc')->pluck("name","id");

        return response()->json($returnData);

    }

    public function apiEditUserResume(Request $request){
        
        $user = $request->user();


        if($user->resume != null){
            $resume = $user->resume;
        }else{
            $resume = new Resume;
        }
        return response()->json($request->userResume);
        
        
        $resume->category;
        $resume->city;


        $user->email =  $request->userResume["email"];
        $resume->body = $request->userResume["body"];
        $resume->education = $request->userResume["education"];
        $resume->nationality = $request->userResume["nationality"];
        $resume->workPermit = $request->userResume["workPermit"];
        $resume->user_id = $user->id;
         
        $user->save();
        $resume->save();

        $resume->category()->sync( [ $request->userResume["category"] ] );
        $resume->city()->sync( [ $request->userResume["city"] ]);


        return response()->json("OK");
    }
}
