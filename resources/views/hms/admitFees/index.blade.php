@extends('main')

@section('title','| Admission Fee')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop

@section('content')
<div class="row">
	<div class="col-md-4">
		<h1>Admission Fee</h1>
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
						<td>{{date('d/M/Y, D',strtotime($hosteller->admission_date))}}</td>
						<td>
						<!-- Pay Modal -->
						  <div class="modal fade" id="Pay<?php echo $hosteller->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						      <div class="modal-content">
						        <div class="modal-header">
						          <h2>Payment Confirmation</h2>
						        </div>
						        <div class="modal-body">
						           <h3>Pay admission fee of {{$hosteller->name}}? </h3>
						            {!! Form::open(['route'=>['admitFee.store',$hosteller->id],'data-parsley-validate'=>'','method'=>'post']) !!}

					            		{{Form::hidden('hosteller_id',$hosteller->id,['class'=>'form-control'])}}

					      				{{Form::label('date')}}
										{{Form::date('date',null,['class'=>'form-control','data-parsley-required'=>''])}}
										
										{{Form::label('receipt_no')}}
										{{Form::text('receipt_no',null,['class'=>'form-control'])}}

										{{Form::label('amount')}}
										{{Form::number('amount',null,['class'=>'form-control','data-parsley-required'=>''])}}

										{{Form::label('remarks')}}
										{{Form::text('remarks',null,['class'=>'form-control'])}}
										
										{{Form::submit('Pay',['class'=>'btn btn-success btn-block' ,'style'=>'margin-top:20px'])}}
						        </div>
						        <div class="modal-footer">
						      			
							  			{!! Form::close() !!}
							  		
						          		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						        </div>
						      </div>
						    </div>
						  </div>
						  @if(!$hosteller->admitFee)
						  <a href="#Pay{{$hosteller->id}}"  role="button" class="btn btn-primary btn-xs" data-toggle="modal" title="Pay"><i class="fa fa-inr" aria-hidden="true"></i> Pay</a>
						  @else
						  <img src="/images/paid.png" alt="..." height="10%" >
						  @endif
						<!-- End Pay Modal -->
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