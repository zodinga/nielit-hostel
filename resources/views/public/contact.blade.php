@extends('main')
@section('title','| Contact')
@section('content')
<div class="row">
	<div class="col-md-12">
		<h1>Contact Us</h1>
		<hr>
		<form action="{{route('public.contact')}}" method="POST">
		{{csrf_field()}}
			<div class="form-group">
				<label for="email">Your Email:</label>
				<input type="email" id="email" name="email" class="form-control" autofocus="">
			</div>
			<div class="form-group">
				<label for="subject">Subject:</label>
				<input type="text" id="subject" name="subject" class="form-control">
			</div>
			<div class="form-group">
				<label for="message">Message:</label>
				<textarea id="message" name="message" class="form-control"></textarea>
			</div>
			<input type="submit" value="Send" class="btn btn-primary">
		</form>
	</div>
</div>
@stop