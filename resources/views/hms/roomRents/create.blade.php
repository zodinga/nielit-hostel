@extends('main')
@section('title','| Room Rent')
@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-9">
			<h2>Room Rent Payments of {{$hosteller->name}}</h2>
			<table class="table">
				<thead>
					<tr>
						<th>Date</th>
						<th>Receipt</th>
						<th>From</th>
						<th>To</th>
						<th>Amount</th>
						<th>Remarks</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				@foreach($roomRents as $roomRent)
					<tr>
						<td>{{date('d M, Y, D',strtotime($roomRent->date))}}</td>
						<td>{{$roomRent->receipt_no}}</td>
						<td>{{date('M, Y',strtotime($roomRent->from))}}</td>
						<td>{{date('M, Y',strtotime($roomRent->to))}}</td>
						<td><i class="fa fa-rupee" aria-hidden="true"></i> {{$roomRent->amount}}</td>
						<td>{{$roomRent->remarks}}</td>
						<td><img src="/images/paid.png" alt="..." height="8%" ></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
			<h2>New Payment</h2>
				 {!! Form::open(['route'=>['roomRent.store',$hosteller->id],'data-parsley-validate'=>'','method'=>'post']) !!}

            		{{Form::hidden('hosteller_id',$hosteller->id,['class'=>'form-control'])}}

      				{{Form::label('date')}}
					{{Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control','data-parsley-required'=>''])}}
					
					{{Form::label('receipt_no')}}
					{{Form::text('receipt_no',null,['class'=>'form-control'])}}

					{{Form::label('from')}}
					<input class="form-control" data-parsley-required="" name="from" type="month" id="from">

					{{Form::label('to')}}
					<input class="form-control" data-parsley-required="" name="to" type="month" id="to">
					
					{{Form::label('amount')}}
					<div class="input-group">
						<span class="input-group-addon" id="sizing-addon2"><i class="fa fa-rupee" aria-hidden="true"></i></span>
						{{Form::number('amount',null,['class'=>'form-control','data-parsley-required'=>''])}}
					</div>

					{{Form::label('remarks')}}
					{{Form::text('remarks',null,['class'=>'form-control'])}}
					
					{{Form::submit('Pay',['class'=>'btn btn-success btn-block' ,'style'=>'margin-top:20px'])}}
	      			
	  			{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop