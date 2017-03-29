@extends('main')
@section('title','| Admit')

@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="well">
				{!!Form::open(['route'=>'admissions.store','data-parsley-validate'=>'','method'=>'POST'])!!}
					<h2>New Admission</h2>
					{{Form::label('building')}}
					{{Form::select('building', ['Boys'=>'Boys', 'Girls'=>'Girls'], $sex=='M'?'Boys':'Girls', ['id'=>'building','placeholder' => 'Pick a building...','class'=>'form-control','data-parsley-required'=>''])}}

					{{Form::label('room')}}
					{{Form::select('room', $room_vacant, null, ['id'=>'room','placeholder' => 'Pick a room...','class'=>'form-control','autofocus','data-parsley-required'=>''])}}

					{{Form::hidden('student_id',$student->id,['class'=>'form-control','data-parsley-required'=>''])}}

					{{Form::label('name')}}
					{{Form::text('name',$student->name,['class'=>'form-control','data-parsley-required'=>''])}}

					{{Form::label('course_id','Course')}}
					{{Form::text('course',$student->course->name,['class'=>'form-control','data-parsley-required'=>'','disabled'])}}
					{{Form::hidden('course_id',$student->course_id,['class'=>'form-control','data-parsley-required'=>''])}}

					{{Form::label('phone')}}
					{{Form::text('phone',$student->phone,['class'=>'form-control','data-parsley-required'=>''])}}

					{{Form::label('guardian')}}
					{{Form::text('guardian',$student->guardian_me,['class'=>'form-control','data-parsley-required'=>''])}}

					{{Form::label('guardian_phone')}}
					{{Form::text('guardian_phone',$student->guardian_phone,['class'=>'form-control','data-parsley-required'=>''])}}

					{{Form::label('admission_date')}}
					{{Form::date('admission_date',null,['class'=>'form-control','data-parsley-required'=>''])}}
					
					{{Form::label('remarks')}}
					{{Form::text('remarks',null,['class'=>'form-control'])}}
					
					{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}
				{!! Form::close()!!}
			</div>
		</div>
		<div class="col-md-6">
			<table class="table table-bordered">
			<caption>{{$sex=='M'?'Boys Hostel':'Girls Hostel'}}</caption>
				<thead>
					<th>Floor</th>
					<th>Room</th>
					<th class="text-center">Bed 1</th>
					<th class="text-center">Bed 2</th>
				</thead>
				<tbody>
					@foreach($rooms as $room)
					<tr>
						<td>{{$room->floor}}</td>
						<td>{{$room->room_no}}</td>
						<td>{{$room->hosteller_1['name']}}</td>
						<td>{{$room->hosteller_2['name']}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	<script>
		$(document).ready( function ()
		{
			$('#building').change(function(){
				var id = this.value;
				//alert(id);
				$("#room").empty();
				$.get('/ajax-room?id='+id,function(data){
					$.each(data, function (i, dat) {
					   $("#room").append("<option value='"+dat.id+"'>" + dat.room_no + "</option>");
					});

				});
			});
		});
	</script>
@stop