@extends('layouts.master')
@section('content')
	<h1 class="pagetitle">Özgeçmişinizi Oluşturunuz</h1>
	
	{!! Form::open(['url' => 'resumes']) !!}

	<div class="form-group">
		{!! Form::label('body', 'Kısa Özgeçmiş', ['class' => 'form']) !!}
		{!! Form::textarea('body','',['class' => 'form-control wysiwyg']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('category', 'Mesleğiniz') !!}
		{!! Form::select('category',$resumeParameters["categories"],null,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('education', 'Eğitim') !!}
		{!! Form::select('education',
			["İlk Okul"=>"İlk Okul",
			"Orta Okul"=>"Orta Okul",
			"Lise"=>"Lise",
			"Üniversite"=>"Üniversite",
			"Yüksek Lisans"=>"Yüksek Lisans"]
			,null,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('nationality', 'Uyruk') !!}
		{!! Form::select('nationality',["KKTC"=>"KKTC","TC"=>"TC","Diğer"=>"Diğer"],null,['class' => 'form-control']) !!}
	</div>

<div class="form-group">
		{!! Form::label('city', 'Şehir') !!}
		{!! Form::select('city',$resumeParameters["cities"],null,['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::checkbox('workPermit','1') !!} {!! Form::label('workPermit', 'Çalışma İznim Var') !!} 
	</div>



	{!! Form::token() !!}

	{!! Form::submit("Gönder" ,['class' => "btn btn-primary"]) !!}

	{!! Form::close() !!}


	
@stop