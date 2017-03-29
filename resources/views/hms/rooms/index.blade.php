@extends('main')
@section('title','| Rooms')

@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1>Rooms</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Building</th>
						<th>Floor</th>
						<th>Room</th>
						<th>Beds</th>
						<th>Hosteller 1</th>
						<th>Hosteller 2</th>
					</tr>
				</thead>
				<tbody>
				@foreach($rooms as $room)
					<tr>
						<td>{{$room->id}}</td>
						<td>{{$room->building}}</td>
						<td>{{$room->floor}}</td>
						<td>{{$room->room_no}}</td>
						<td>{{$room->beds}}</td>
						<td>
							@if($room->hosteller_1)
								<a href="{{route('hostellers.show',$room->hosteller_1->id)}}">{{$room->hosteller_1->name}}</a>
							@else
								<b>---</b>
							@endif
						</td>
						<td>
							@if($room->hosteller_2)
								<a href="{{route('hostellers.show',$room->hosteller_2->id)}}">{{$room->hosteller_2->name}}</a>
							@else
								<b>---</b>
							@endif
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
				{!!Form::open(['route'=>'rooms.store','data-parsley-validate'=>'','method'=>'POST'])!!}
					<h2>New Room</h2>
					{{Form::label('building')}}
					{{Form::select('building', ['Boys'=>'Boys', 'Girls'=>'Girls'], null, ['placeholder' => 'Pick a building...','class'=>'form-control','autofocus','required'=>''])}}

					{{Form::label('floor')}}
					{{Form::text('floor',null,['class'=>'form-control','required'=>''])}}

					{{Form::label('room_no')}}
					{{Form::text('room_no',null,['class'=>'form-control','required'=>''])}}

					{{Form::label('beds')}}
					{{Form::text('beds',null,['class'=>'form-control','required'=>''])}}
					
					{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}
				{!! Form::close()!!}
			</div>
		</div>
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop