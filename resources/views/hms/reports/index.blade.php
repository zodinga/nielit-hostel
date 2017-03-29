@extends('main')
@section('title','| Reports')
@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
<div class="row">

 	<div class="col-md-3">
	   <a href="{{route('reports.custom')}}" class="btn btn-primary btn-lg btn-block" role="button">
	    <div class="thumbnail">
	      <img src="#" alt="..." height="auto" width="100%">
	      <div class="caption">
	        <h3>Custom <span class="badge" style="background-color: #468847; color: white;"></span></h3>
	        <p>...</p>
	        
	      </div>
	    </div>
	    </a>
 	</div>

 	<div class="col-md-3">
	   <a href="{{route('reports.custom')}}" class="btn btn-primary btn-lg btn-block" role="button">
	    <div class="thumbnail">
	      <img src="#" alt="..." height="auto" width="100%">
	      <div class="caption">
	        <h3>Pending Mess <span class="badge" style="background-color: #468847; color: white;"></span></h3>
	        <p>...</p>
	        
	      </div>
	    </div>
	    </a>
 	</div>

 	<div class="col-md-3">
	   <a href="{{route('reports.custom')}}" class="btn btn-primary btn-lg btn-block" role="button">
	    <div class="thumbnail">
	      <img src="#" alt="..." height="auto" width="100%">
	      <div class="caption">
	        <h3>Boys <span class="badge" style="background-color: #468847; color: white;"></span></h3>
	        <p>...</p>
	        
	      </div>
	    </div>
	    </a>
 	</div>

 	<div class="col-md-3">
	   <a href="{{route('reports.custom')}}" class="btn btn-primary btn-lg btn-block" role="button">
	    <div class="thumbnail">
	      <img src="#" alt="..." height="auto" width="100%">
	      <div class="caption">
	        <h3>Girls <span class="badge" style="background-color: #468847; color: white;"></span></h3>
	        <p>...</p>
	        
	      </div>
	    </div>
	    </a>
 	</div>

</div>		
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop