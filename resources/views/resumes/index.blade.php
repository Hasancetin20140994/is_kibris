@extends('layouts.master')
@section('content')
	<h1 class="pagetitle">Servis Yenileme</h1>
	<table class="table">
		<tr>
			<th>İsim</th><th>Body</th><th>Phone</th><th>Email</th><th></th><th></th><th></th>
		</tr>
		<?php foreach($resumes as $resume){ ?>
			<tr>
			<td>{{$resume["name"]}}</td>
			<td>{{$resume["body"]}}</td>
			<td>{{$resume["phone"]}}</td>
			<td>{{$resume["email"]}}</td>
			<td><a href="/resumes/{{$resume['id']}}/edit" class="btn btn-primary">Edit</a></td>
			<td><a href="/resumes/{{$resume['id']}}" class="btn btn-info">View</a></td>
			<td>{!! Form::open(['url' => 'resumes/'.$resume->id,'method' => 'delete']) !!}
			{!! Form::token() !!}
			{!! Form::submit("Sil" ,['class' => "btn btn-danger"]) !!}

			</td>
			</tr>
			
			

		<?php } ?>
		<tr>
			<td colspan="7"><a href="/resumes/create" class="btn btn-success">Create</a>
		</tr>

	</table>


	
@stop