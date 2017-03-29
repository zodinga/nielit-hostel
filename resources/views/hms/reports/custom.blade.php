@extends('main')
@section('title','| Reports')
@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')

	<div class="row">
		<div class="col-md-3">
			<h1>Custom Report</h1>
		</div>
		<div class="col-md-3">
			{!! Form::open(['route'=>'reports.custom','data-parsley-validate'=>'','method'=>'post']) !!}
			{{Form::text('h_name',null,['class'=>'form-control','placeholder'=>'Name'])}}
			{{Form::select('h_course_id', $courses ,null,['class'=>'form-control','placeholder' => 'Pick a course...'])}}
			{{Form::select('sex', ['Boys','Girls'] ,null,['class'=>'form-control','placeholder' => 'Pick a gender...'])}}
		</div>
		<div class="col-md-3">
			<table class="table table-bordered">
			<thead>
				<th>Field Name</th>
				<th>{{Form::checkbox('select_all',null,null,['id'=>'checkAll'])}} Select All</th>
			</thead>
			@foreach($hosteller_table as $table)
			<tr>
				<td class="text-success">{{Form::label($table)}}</td>
				<td>{{Form::checkbox($table,null,null,['class'=>'chk'])}}</td>
			</tr>	
			@endforeach
			</table>
		</div>
		<div class="col-md-3">
				<input type="image" src="/images/excel.png" alt="Submit" width="80">
				
			{!! Form::close() !!}
		</div>
	</div>		
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	<script>
		$(document).ready( function ()
		{
			$('#checkAll').change(function () {
			    $('.chk').prop('checked', this.checked);
			});

			$(".chk").change(function () {
		    if ($(".chk:checked").length == $(".chk").length) {
		        $('#checkAll').prop('checked', 'checked');
		    } else {
		        $('#checkAll').prop('checked', false);
		    }
		});
		});
	</script>
@stop