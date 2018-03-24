<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



/*Jobs*/
Route::get('jobs', 'JobsController@index');
Route::get('jobs/create', 'JobsController@create');
Route::get('jobs/{id}', 'JobsController@show')->where('id', '[0-9]+');
Route::post('jobs', 'JobsController@store');
Route::get('jobs/{id}/edit', 'JobsController@edit')->where('id', '[0-9]+');
Route::put('jobs/{id}', 'JobsController@update')->where('id', '[0-9]+');
Route::delete('jobs/{id}', 'JobsController@destroy')->where('id', '[0-9]+');

/*Resumes*/
Route::get('resumes', 'ResumesController@index');
Route::get('resumes/create', 'ResumesController@create');
Route::get('resumes/{id}', 'ResumesController@show')->where('id', '[0-9]+');
Route::post('resumes', 'ResumesController@store');
Route::get('resumes/{id}/edit', 'ResumesController@edit')->where('id', '[0-9]+');
Route::put('resumes/{id}', 'ResumesController@update')->where('id', '[0-9]+');
Route::delete('resumes/{id}', 'ResumesController@destroy')->where('id', '[0-9]+');

/*Users*/
Route::get('user/login', 'UserController@loginForm');
Route::post('user/login', 'UserController@doLogin');
Route::get('user/register', 'UserController@registerForm');
Route::post('user/register', 'UserController@doRegister');