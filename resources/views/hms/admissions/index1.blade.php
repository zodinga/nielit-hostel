@extends('main')

@section('title','| Admission')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop

@section('content')
<div class="row">
	<div class="col-md-2">
		<h1>Admission</h1>
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
	<div class="col-md-9">
		
		<table class="table">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Sex</th>
				<th>Course</th>
				<th>Yoj</th>
				<th>Present Address</th>
				<th>Permanent Address</th>
				<th>Photo</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach($students as $student)
					<tr>
						<td>{{$student->id}}</td>
						<td>{{$student->name}}</td>
						<td>{{$student->sex}}</td>
						<td>{{$student->course->name}}</td>
						<td>{{$student->doj}}</td>
						<td>{{$student->per_street, $student->per_city, $student->per_district, $student->per_state, $student->per_pin}}</td>
						<td>{{$student->per_street, $student->pre_city, $student->pre_district, $student->pre_state, $student->pre_pin}}</td>
						<td><img src="{{$student->image?asset('images/'.$student->image):'/images/question.jpg'}}" alt="..." class="img-rounded" height="33" width="28"> </td>
						<td>
						<!-- Admit Modal -->
						  <div class="modal fade" id="Admit<?php echo $student->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						      <div class="modal-content">
						        <div class="modal-header">
						          <h2>Admit Confirmation</h2>
						        </div>
						        <div class="modal-body">
						            Are you sure to Admit... {{$student->name}} to hostel?
						        </div>
						        <div class="modal-footer">
						        	
						           
						      			{!! Form::open(['route'=>['admissions.store',$student->id],'method'=>'put']) !!}
						      				{{Form::select('building', ['Boys'=>'Boys', 'Girls'=>'Girls'], null, ['placeholder' => 'Pick a building...','class'=>'form-control','autofocus','required'=>''])}}
											{{Form::select('room_no', $room_vacant, null, ['placeholder' => 'Pick a building...','class'=>'form-control','autofocus','required'=>''])}}
											{{Form::submit('Admit',['class'=>'btn btn-danger btn-lg'])}}
							  			{!! Form::close() !!}
							  		
							  		
						          		<button type="button" class="btn btn-warning btn-lg" data-dismiss="modal">Cancel</button>
						        
						        </div>
						      </div>
						    </div>
						  </div>
						  <a href="#Admit{{$student->id}}"  role="button" class="btn btn-success btn-block" data-toggle="modal" title="Admit Paper"><span class="glyphicon glyphicon-remove-circle"></span> Admit</a>
						<!-- End Admit Modal -->
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
				{!! $students->appends(Request::except('page'))->links() !!}
	</div>


</div>
@stop

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop