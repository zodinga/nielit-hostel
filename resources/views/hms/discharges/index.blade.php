@extends('main')

@section('title','| Discharge')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop

@section('content')
<div class="row">
	<div class="col-md-4">
		<h1>Discharge</h1>
	</div>
	<div class="col-md-6">
	
				{!!Form::open(['route'=>'hms.students.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
			        <div class="form-group">
			          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Name">
			        </div>
			        <button type="submit" class="btn btn-success form-spacing-top">Search</button>
				{!!Form::close()!!}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Room</th>
				<th>Course</th>
				<th>Phone</th>
				<th>Guardian</th>
				<th>G Phone</th>
				<th>Admit Date</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach($hostellers as $hosteller)
					<tr>
						<td>{{$hosteller->id}}</td>
						<td>{{$hosteller->name}}</td>
						<td>
						@if($hosteller->bed_1)
							{{$hosteller->bed_1->room_no}}
						@else
							{{$hosteller->bed_2->room_no}}
						@endif
						</td>
						<td>{{$hosteller->course_id}}</td>
						<td>{{$hosteller->phone}}</td>
						<td>{{$hosteller->guardian}}</td>
						<td>{{$hosteller->guardian_phone}}</td>
						<td>{{date('d/M/Y',strtotime($hosteller->admission_date))}}</td>
						<td>
						<a href="{{route('discharge.show',$hosteller->id)}}" class="btn btn-info">Process</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
				{!! $hostellers->appends(Request::except('page'))->links() !!}
	</div>


</div>
@stop

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop