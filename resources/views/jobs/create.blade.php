@extends('layouts.master')
@section('content')
	<h1 class="pagetitle">İş İlanı Ekle</h1>
	
	{!! Form::open(['url' => 'jobs']) !!}
	<div class="form-group">
		{!! Form::label('name', 'İş Tanımı') !!}
		{!! Form::text('name',null,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('body', 'İş Detayı', ['class' => 'form']) !!}
		{!! Form::textarea('body','',['class' => 'form-control wysiwyg']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('phone', 'Telefon Numarası') !!}
		{!! Form::text('phone','',['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email') !!}
		{!! Form::text('email','',['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('category', 'İş Kategorisi') !!}
		{!! Form::select('category',$jobParameters["categories"],null,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('type', 'Çalışma Türü') !!}
		{!! Form::select('type',$jobParameters["types"],null,['class' => 'form-control']) !!}
	</div>
	
	<div class="form-group">
		{!! Form::label('city', 'Şehir') !!}
		{!! Form::select('city',$jobParameters["cities"],null,['class' => 'form-control']) !!}
	</div>



	{!! Form::token() !!}

	{!! Form::submit("Gönder" ,['class' => "btn btn-primary"]) !!}

	{!! Form::close() !!}


	
@stop