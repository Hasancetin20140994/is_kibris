<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Jobs;
use App\Category;
use App\City;
use App\Type;
use App\SavedSearches;
use Mail;
use PushNotification;

class JobsController extends Controller
{
    
    public function index(Request $request){
        $deviceToken = "213231231121231112123123";
        PushNotification::app('appNameAndroid')
                ->to($deviceToken)
                ->send('Hello World, i`m a push message');


        /*
    	$jobs = Jobs::all();
    	return view('jobs.index', ['jobs' => $jobs]);*/
    }

    public function create(Request $request){
        $jobParameters = array();

        $jobParameters["categories"] = Category::orderBy('name', 'asc')->pluck("name","id");
        $jobParameters["cities"] = City::orderBy('name', 'asc')->pluck("name","id");
        $jobParameters["types"] = Type::orderBy('name', 'asc')->pluck("name","id");
    	return view('jobs.create',['jobParameters' => $jobParameters]);
    }

    public function store(Request $request){
		$job = new Jobs;

		$now = Carbon::now(); 

		$job->name = $request->name;
		$job->body = $request->body;
		$job->phone = $request->phone;
		$job->email = $request->email;
		$job->isFeatured = 0;
		$job->user_id = 1;
		$job->company_id = 1;
		$job->startDate = $now->format('Y-m-d H:i:s');
		$job->endDate = $now->addMonths(1)->format('Y-m-d H:i:s');;
		$job->save();

        $job->category()->attach($request->category);
        $job->city()->attach($request->city);
        $job->type()->attach($request->type
            );
    }

    public function show(Request $request,$id){
    	$job = Jobs::with("category")->find($id);
        return view('jobs.show', ['job' => $job]);	
    }

    public function edit(Request $request,$id){
    	$job = Jobs::where('id',$id)->first();
    	return view('jobs.edit', ['job' => $job]);
    }

    public function update(Request $request,$id){
    	$job = Jobs::where('id',$id)->first();


		$job->name = $request->name;
		$job->body = $request->body;
		$job->phone = $request->phone;
		$job->email = $request->email;
		$job->save();
		
    }

    public function destroy(Request $request,$id){
    	$job = Jobs::where('id',$id)->first();


    	$job->delete();
    }

    /*Api Controller*/
    
		//Search results (ana sayfa için de benzerini kullanabilin)
    public function apiIndex(Request $request){
        $jobs = Jobs::query();
		
        //return response()->json(($request->city));
        if( isset($request->city) ){
            $jobs->whereHas( "city",function($query) use($request){
                 $query->where('id', intval($request->city) );
            });
        }
        if( isset($request->category) ){
            $jobs->whereHas( "category",function($query) use($request){
                 $query->where('id', intval($request->category) );
            });
        }
		if( isset($request->type) ){
            $jobs->whereHas( "type",function($query) use($request){
                 $query->where('id', intval($request->type) );
            });
        }
		
		
		if( isset($request->education) ){
            $jobs->where('education_id', intval($request->education) );

        }

		
		$jobs->orderBy('created_at', 'desc');
		

        $jobs->with("category")->with("type")->with("city")->with("company");
		
		if( isset($request->count) ){
			$jobs->paginate($request->count);	
		}
		
    	return response()->json( $jobs->get());
    }
		//İlan sayfası
    public function apiShow(Request $request,$id){
    	$job = Jobs::find($id);
        $job->category;
        $job->city;
		$job->type;
		$job->education;
		$job->company;
        return response()->json($job);
    }
		//Search ve ilan oluşturma formu
    public function apiGetFields(Request $request){
        $jobParameters = array();


        $jobParameters["categories"] = Category::orderBy('name', 'asc')->pluck("name","id");
        $jobParameters["cities"] = City::orderBy('name', 'asc')->pluck("name","id");
        $jobParameters["types"] = Type::orderBy('name', 'asc')->pluck("name","id");
        return response()->json($jobParameters);
    }
		
		//İlan oluşturmak
    public function apiStore(Request $request){
        $user = $request->user();
        $company = $user->company;

        $job = new Jobs;

        $now = Carbon::now(); 

        $job->name = $request->name;
        $job->body = $request->body;
        $job->phone = $request->phoneNumber;
        $job->email = $request->email;
        $job->isFeatured = 0;
        $job->user_id = $user->id;
        $job->company_id = $company->id;
        $job->startDate = $now->format('Y-m-d H:i:s');
        $job->endDate = $now->addMonths(1)->format('Y-m-d H:i:s');

        $job->save();
        $job->category()->attach($request->category);
        $job->city()->attach($request->city);
        return response()->json($job->id);
    }

    public function apiUpdate(Request $request){

    }

    public function apiDestroy(Request $request){

    }

    public function apiApplyJob(Request $request,$id){
        
/*
        DB::table('applications')->insert(
            ['user_id' => $request->user()->id, 'jobs_id' => $id]
        );
*/
        $job = Jobs::find($id);
        $user = $request->user();
        $user->resume;
		
		

        DB::table('applications')->insert([
            ['jobs_id' => $job->id, 'user_id' => $user->id, 'application_text' => $request->applicationText]
        ]);

                $mailData = array(
                'user'=>$user,
                'job'=>$job,
                'applicationText'=>$request->applicationText
            );

        $template = "email.application";
		
        Mail::send($template, ['mailData'=>$mailData], function ($message) use ($mailData) {

				$emails = ["webadmin@innovia.biz"];
				
				if($mailData["job"]->email){
					$emails[] = $mailData["job"]->email;
				}
                $message->from('system@iskibris.com', 'İŞKIBRIS');
                $message->to($emails);
                $message->subject("İş Başvurusu");
                
        });

        


        return response()->json("OK");
    }
		//Başvurulmuş ilanlar
    public function apiAppliedJobs(Request $request){
        $user = $request->user();

        $jobsIdArray = DB::table('applications')->where('user_id', '=', $user->id)->pluck("jobs_id");
			
		$jobs = Jobs::whereIn("id",$jobsIdArray)->with("category")->with("type")->with("city")->with("company")->get();
		

            return response()->json($jobs);
    }
		//Kullanıcının oluşturduğu ilanlar
    public function apiMyJobs(Request $request){
        $user = $request->user();

        $jobs = Jobs::where("user_id",$user->id)->with("city")->with("category")->get();
        


        return response()->json($jobs);
    }
		//Kaydedilmiş aramaları almak için
    public function apiGetSaveSearch(Request $request){
        $user = $request->user();
        $sss = SavedSearches::where("user_id",$user->id)->get();
        $params = array();
        foreach ($sss as $key => $ss) {
            $tempObj = $ss;
			$tempObj->parameters = unserialize($ss->parameters); 
           array_push($params,$tempObj);
        }
        return response()->json($params);

        
    }
		//Kaydedilmiş aramaları silmek için
	public function apiRemoveSaveSearch(Request $request){
        	
			
        $user = $request->user();
		
		$ss = SavedSearches::find($request->id);
		
		if($ss->user_id == $user->id){
			$ss->forceDelete();
			 return response()->json("ok");
			
		}

        
    }
	
	
		//Arama kaydet
    public function apiSaveSearch(Request $request){
        $user = $request->user();

        $nss = new SavedSearches;

        $nss->user_id = $user->id;
        
        $params = array();
        if($request->keyword){
            $params["keyword"] = $request->keyword;
        }
        if($request->education){
            $params["education"] = $request->education;
        }
        if($request->category){
            $params["category"] = $request->category;
        }
        if($request->type){
            $params["type"] = $request->type;
        }
        if($request->city){
            $params["city"] = $request->city;
        }

        $nss->parameters = serialize($params);
        $nss->name = $request->name;
        $nss->save();

        return response()->json($nss->id);

        
    }
		//Kullanıcı bu ilana başvurdu mu?
	public function apiCheckUserAplied(Request $request ,$id ){
        $user = $request->user();
		
		$applications = DB::table('applications')->where("jobs_id",'=',$id)->where("user_id",'=',$user->id)->get();

        return response()->json(
			["applied" => ( count($applications) > 0 )]
		);
    }
}
