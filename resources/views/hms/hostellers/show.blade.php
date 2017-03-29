@extends('main')
@section('title','| Hosteller')

@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<ul class="list-group">
		  <li class="list-group-item list-group-item-success"><b>HOSTEL ID: </b>{{$hosteller->id}}</li>
		  <li class="list-group-item list-group-item-info"><b>NAME: </b>{{$hosteller->name}}</li>
		  <li class="list-group-item list-group-item-warning"><b>COURSE: </b>{{$hosteller->course->name}}</li>
		  <li class="list-group-item list-group-item-danger"><b>PHONE: </b>{{$hosteller->phone}}</li>
		  <li class="list-group-item list-group-item-success"><b>GUARDIAN: </b>{{$hosteller->guardian}}</li>
		  <li class="list-group-item list-group-item-info"><b>GUARDIAN PHONE: </b>{{$hosteller->guardian_phone}}</li>
		  <li class="list-group-item list-group-item-success"><b>ADMIT DATE: </b>{{$hosteller->admission_date}}</li>
		</ul>
	</div>
</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop