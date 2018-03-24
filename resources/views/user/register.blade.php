@extends('layouts.master')
@section('content')
	<h1 class="pagetitle">Register</h1>
	
	{!! Form::open(['url' => 'user/register']) !!}
	<div class="form-group">
		{!! Form::label('name', 'İsim Soyisim') !!}
		{!! Form::text('name',null,['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('email', 'Email') !!}
		{!! Form::text('email',null,['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('phoneNumber', 'Telefon') !!}
		{!! Form::text('phoneNumber',null,['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('password', 'Parola') !!}
		{!! Form::password('password',['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('password2', 'Parola Tekrar') !!}
		{!! Form::password('password2',['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('type', 'Kullanıcı Türü') !!}
		{!! Form::select('type',['candidate' => "İş Arayan", 'empoyer' => "İş Veren"],'candidate',['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::checkbox('visible','1') !!} {!! Form::label('visible', 'Profilimi Herkes Görebilsin') !!} 
	</div>

	

	{!! Form::token() !!}

	{!! Form::submit("Kaydol" ,['class' => "btn btn-primary"]) !!}

	{!! Form::close() !!}


	
@stop