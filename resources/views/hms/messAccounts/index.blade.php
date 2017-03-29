@extends('main')
@section('title','| Mess Account')
@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-9">
			<h2>Mess Account</h2>
			<table class="table">
			<caption><b class="text-success">Total Income: <i class="fa fa-rupee" aria-hidden="true"></i> {{$income}}</b> | <b class="text-danger">Total Expense: <i class="fa fa-rupee" aria-hidden="true"></i> {{$expense}}</b> | <b class="text-primary">Balance: <i class="fa fa-rupee" aria-hidden="true"></i> {{$income-$expense}}</b></caption>
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Income</th>
						<th>Expense</th>
						<th>Narration</th>
					</tr>
				</thead>
				<tbody>
				@foreach($messAccounts as $messAccount)
					<tr>
						<td>{{$messAccount->id}}</td>
						<td>{{date('d M, Y, D',strtotime($messAccount->date))}}</td>
						<td class="text-success"><i class="fa fa-rupee" aria-hidden="true"></i> {{$messAccount->income}}</td>
						<td class="text-danger"><i class="fa fa-rupee" aria-hidden="true"></i> {{$messAccount->expense}}</td>
						<td>{{$messAccount->narration}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
			{!! $messAccounts->appends(Request::except('page'))->links() !!}
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well" style="background-color: #ff4d4d;">
			<h2>New Expense</h2>
				 {!! Form::open(['route'=>'messAccount.store','data-parsley-validate'=>'','method'=>'post']) !!}

      				{{Form::label('date')}}
					{{Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control','data-parsley-required'=>''])}}
					
					{{Form::label('amount')}}
					<div class="input-group">
						<span class="input-group-addon" id="sizing-addon2"><i class="fa fa-rupee" aria-hidden="true"></i></span>
						{{Form::number('amount',null,['class'=>'form-control','data-parsley-required'=>''])}}
					</div>

					{{Form::label('narration')}}
					{{Form::text('narration',null,['class'=>'form-control','data-parsley-required'=>''])}}
					
					{{Form::submit('Pay',['class'=>'btn btn-success btn-block' ,'style'=>'margin-top:20px'])}}
	      			
	  			{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop