@extends('main')

@section('title','| Show')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>Show</h1>
		<h3>Name: {{$hosteller->name}}</h3>
		<h4>Admitted on: {{date('d M, Y',strtotime($hosteller->admission_date))}}</h4>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<table class="table table-striped table-bordered">
		<caption>Paid Admit Fees</caption>
			<thead>
				<th>Date</th>
				<th>Receipt</th>
				<th>Amount</th>
				<th>Remarks</th>
			</thead>
			<tbody>
				@foreach($admitFees as $admitFee)
					<tr>
						<td>{{date('d/m/y',strtotime($admitFee->date))}}</td>
						<td>{{$admitFee->receipt_no}}</td>
						<td>{{$admitFee->amount}}</td>
						<td>{{$admitFee->remarks}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<b class="text-danger">{{$admit_pending}}</b>
	</div>

	<div class="col-md-5">
		<table class="table table-striped table-bordered">
		<caption>Paid Room Rent</caption>
			<thead>
				<th>Date</th>
				<th>Receipt</th>
				<th>From</th>
				<th>To</th>
				<th>Amount</th>
				<th>Remarks</th>
			</thead>
			<tbody>
				@foreach($roomRents as $roomRent)
					<tr>
						<td>{{date('d/m/y',strtotime($roomRent->date))}}</td>
						<td>{{$roomRent->receipt_no}}</td>
						<td>{{date('M/y',strtotime($roomRent->from))}}</td>
						<td>{{date('M/y',strtotime($roomRent->to))}}</td>
						<td>{{$roomRent->amount}}</td>
						<td>{{$roomRent->remarks}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<b class="text-danger">Pending Room Rent: {{$pending}}</b>
	</div>

	<div class="col-md-4">
		<table class="table table-striped table-bordered">
		<caption>Paid Mess Fees</caption>
			<thead>
				<th>Date</th>
				<th>Receipt</th>
				<th>Month/Year</th>
				<th>Amount</th>
				<th>Remarks</th>
			</thead>
			<tbody>
				@foreach($messFees as $messFee)
					<tr>
						<td>{{date('d/m/y',strtotime($messFee->date))}}</td>
						<td>{{$messFee->receipt_no}}</td>
						<td>{{date('M/Y',strtotime($messFee->month_year))}}</td>
						<td>{{$messFee->amount}}</td>
						<td>{{$messFee->remarks}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<b class="text-danger">Pending Mess Fee: {{$mess_pending}}</b>
	</div>
</div>
<a href="{{route('discharge.show',$hosteller->id)}}" class="btn btn-info">Discharge</a>
@stop

@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop