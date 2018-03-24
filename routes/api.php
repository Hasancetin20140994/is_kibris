<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	

	if($request->user()->type == "candidate"){
		$request->user()->resume;
		$request->user()->resume->category;
		$request->user()->resume->city;
	}else{
		$request->user()->company;
	}

    return $request->user();
});



Route::post('/register', array('uses'=>'UserController@apiRegister') );
Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');
/*General Parameters*/

Route::get('/general', array('uses'=>'GeneralController@apiGetAllGeneralFields') );

Route::post('/doFBLogin', array('uses'=>'UserController@apiDoFBLogin') );

/*Jobs*/
Route::get('/jobs', array('uses'=>'JobsController@apiIndex') );
Route::get('jobs/{id}', 'JobsController@apiShow')->where('id', '[0-9]+');
Route::get('jobs/getfields', 'JobsController@apiGetFields');
Route::middleware('auth:api')->post('jobs', 'JobsController@apiStore');
Route::middleware('auth:api')->post('jobs/{id}/apply', 'JobsController@apiApplyJob')->where('id', '[0-9]+');
Route::middleware('auth:api')->get('jobs/appliedjobs', 'JobsController@apiAppliedJobs');
Route::middleware('auth:api')->get('jobs/myjobs', 'JobsController@apiMyJobs');
Route::middleware('auth:api')->get('saveSearch', 'JobsController@apiGetSaveSearch');
Route::middleware('auth:api')->post('saveSearch', 'JobsController@apiSaveSearch');
Route::middleware('auth:api')->post('removeSaveSearch', 'JobsController@apiRemoveSaveSearch');
Route::middleware('auth:api')->get('jobs/checkUserApplied/{id}', 'JobsController@apiCheckUserAplied')->where('id', '[0-9]+');


/*Resumes*/
Route::get('/resumes', array('uses'=>'ResumesController@apiIndex') );
Route::get('resumes/{id}', 'ResumesController@apiShow')->where('id', '[0-9]+');
Route::get('resumes/create', 'ResumesController@apiCreate');
Route::post('resumes', 'ResumesController@apiStore');

Route::post('uploadresume','ResumesController@apiUploadResume');



Route::middleware('auth:api')->get('userresume', 'ResumesController@apiUserResume');
Route::middleware('auth:api')->post('userresume', 'ResumesController@apiEditUserResume');

Route::middleware('auth:api')->get('usercompany', 'CompanyController@apiUserCompany');
Route::middleware('auth:api')->post('usercompany', 'CompanyController@apiEditUserCompany');

Route::middleware('auth:api')->post('saveIonicToken', 'UserController@saveIonicToken');


Route::middleware('auth:api')->post('uploadimage', array('uses'=>'UserController@uploadImage') );

Route::middleware('auth:api')->post('removeUploadImage', array('uses'=>'UserController@removeUploadImage') );


