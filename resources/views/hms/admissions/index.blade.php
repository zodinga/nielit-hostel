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
	<div class="col-md-12">
		
		<table class="table">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Course</th>
				<th>Yoj</th>
				<th>Present Address</th>
				<th>Permanent Address</th>
				<th>Photo</th>
				<th>Sex</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach($students as $student)
				<form action="{{ route('sex.assign') }}" method="post">
				{{ csrf_field() }}
					<tr>
						<td>{{$student->id}}<input type="hidden" name="id" value="{{ $student->id }}"></td>
						<td>{{$student->name}}</td>
						<td>{{$student->course->name}}</td>
						<td>{{$student->doj}}</td>
						<td>{{$student->per_street, $student->per_city, $student->per_district, $student->per_state, $student->per_pin}}</td>
						<td>{{$student->per_street, $student->pre_city, $student->pre_district, $student->pre_state, $student->pre_pin}}</td>
						<td><img src="{{$student->image?asset('images/'.$student->image):'/images/question.jpg'}}" alt="..." class="img-rounded" height="33" width="28"> </td>
						<td>
							<input type="radio" name="gender" value="M" {{$student->sex=='M'?'checked':''}}> <i class="fa fa-male" aria-hidden="true"></i>
	 						<input type="radio" name="gender" value="F" {{$student->sex=='F'?'checked':''}}> <i class="fa fa-female" aria-hidden="true"></i>
	 						<button type="submit" class="btn btn-success btn-xs">Assign Sex</button>
 						 </td>
						<td>
						@if(!$student->hosteller_1 and !$student->hosteller_2)
						<a href="{{route('admissions.create',$student->id)}}" class="btn btn-warning">Admit</a>
						@endif
						 
						</td>
					</tr>
					</form>
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