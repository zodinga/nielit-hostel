@extends('main')
@section('title','| Reports')
@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
<h1>Boys Report</h1>
	<div class="row">
	<div class="col-md-3">
		{!! Form::open(['route'=>'reports.custom','data-parsley-validate'=>'','method'=>'post']) !!}
		{{Form::text('h_name',null,['class'=>'form-control','placeholder'=>'Name'])}}
		{{Form::select('h_course_id', $courses ,null,['class'=>'form-control','placeholder' => 'Pick a course...'])}}
		
		<input type="image" src="/images/excel.png" alt="Submit" width="80">
			
		{!! Form::close() !!}
	</div>
	</div>		
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop