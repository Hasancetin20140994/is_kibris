@extends('layouts.master')
@section('content')
	<h1 class="pagetitle">Servis Yenileme</h1>
	<table class="table">
		<tr>
			<th>İsim</th><th>Body</th><th>Phone</th><th>Email</th><th></th><th></th><th></th>
		</tr>
		<?php foreach($jobs as $job){ ?>
			<tr>
			<td>{{$job["name"]}}</td>
			<td>{{$job["body"]}}</td>
			<td>{{$job["phone"]}}</td>
			<td>{{$job["email"]}}</td>
			<td><a href="/jobs/{{$job['id']}}/edit" class="btn btn-primary">Edit</a></td>
			<td><a href="/jobs/{{$job['id']}}" class="btn btn-info">View</a></td>
			<td>{!! Form::open(['url' => 'jobs/'.$job->id,'method' => 'delete']) !!}
			{!! Form::token() !!}
			{!! Form::submit("Sil" ,['class' => "btn btn-danger"]) !!}

			</td>
			</tr>
			
			

		<?php } ?>
		<tr>
			<td colspan="7"><a href="/jobs/create" class="btn btn-success">Create</a>
		</tr>

	</table>


	
@stop