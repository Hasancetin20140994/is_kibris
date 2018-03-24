@extends('layouts.master')
@section('content')

	<h1>{{$job["name"]}}</h1>
	<p>{{$job["body"]}}</p>
	<p>{{$job["phone"]}}</p>
	<p>{{$job["email"]}}</p>

	<h3>İş Kategorisi</h3>
	@foreach ($job->category as $category)
		<p>{{$category->name}}</p>
	@endforeach

	
@stop


