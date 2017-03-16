@extends('main')
@section('title','| Mess Fee')
@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-9">
			<h2>Mess Fee Payments of {{$hosteller->name}}</h2>
			<table class="table">
				<thead>
					<tr>
						<th>Date</th>
						<th>Receipt</th>
						<th>Month</th>
						<th>Amount</th>
						<th>Remarks</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				@foreach($messFees as $messFee)
					<tr>
						<td>{{date('d M, Y, D',strtotime($messFee->date))}}</td>
						<td>{{$messFee->receipt_no}}</td>
						<td>{{date('M, Y',strtotime($messFee->month_year))}}</td>
						<td>{{$messFee->amount}}</td>
						<td>{{$messFee->remarks}}</td>
						<td><img src="/images/paid.png" alt="..." height="8%" ></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
			<h2>New Payment</h2>
				 {!! Form::open(['route'=>['messFee.store',$hosteller->id],'data-parsley-validate'=>'','method'=>'post']) !!}

            		{{Form::hidden('hosteller_id',$hosteller->id,['class'=>'form-control'])}}

      				{{Form::label('date')}}
					{{Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control','data-parsley-required'=>''])}}
					
					{{Form::label('receipt_no')}}
					{{Form::text('receipt_no',null,['class'=>'form-control'])}}

					{{Form::label('month_year')}}
					<input class="form-control" data-parsley-required="" name="month_year" type="month" id="month_year">

					{{Form::label('amount')}}
					{{Form::number('amount',null,['class'=>'form-control','data-parsley-required'=>''])}}

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