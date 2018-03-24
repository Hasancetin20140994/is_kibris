@extends('layouts.master')
@section('content')
	<h1 class="pagetitle">Login</h1>
	
	{!! Form::open(['url' => 'user/login']) !!}
	<div class="form-group">
		{!! Form::label('login', 'Email veya Telefon Numarası') !!}
		{!! Form::text('login',null,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('password', 'Parola') !!}
		{!! Form::password('password',['class' => 'form-control']) !!}
	</div>

	

	{!! Form::token() !!}

	{!! Form::submit("Giriş" ,['class' => "btn btn-primary"]) !!}

	{!! Form::close() !!}


	
@stop