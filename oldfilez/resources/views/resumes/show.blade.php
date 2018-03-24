@extends('layouts.master')
@section('content')

	<h1>{{$resume["name"]}}</h1>
	<p>{{$resume["body"]}}</p>
	<p>{{$resume["phone"]}}</p>
	<p>{{$resume["email"]}}</p>

	<h3>İş Kategorisi</h3>
	@foreach ($resume->category as $category)
		<p>{{$category->name}}</p>
	@endforeach

	
@stop


