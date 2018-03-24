@extends('layouts.master')
@section('content')
	<h1 class="pagetitle">İş İlanı Ekle</h1>
	
	{!! Form::open(['url' => 'jobs/'.$job->id,'method' => 'put']) !!}
	<div class="form-group">
		{!! Form::label('name', 'İş Tanımı') !!}
		{!! Form::text('name',$job->name,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('body', 'İş Detayı', ['class' => 'form']) !!}
		{!! Form::textarea('body',$job->body,['class' => 'form-control wysiwyg']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('phone', 'Telefon Numarası') !!}
		{!! Form::text('phone',$job->phone,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email') !!}
		{!! Form::text('email',$job->email,['class' => 'form-control']) !!}
	</div>

	{!! Form::token() !!}

	{!! Form::submit("Gönder" ,['class' => "btn btn-primary"]) !!}

	{!! Form::close() !!}


	
@stop