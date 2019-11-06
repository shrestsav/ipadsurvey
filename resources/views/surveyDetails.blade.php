@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header border-0">
		<div class="row">
			<div class="col-6">
				<h3 class="mb-0">Survey Details</h3>
			</div>
			<div class="col-6 text-right">
				{{-- <a href="#" class="btn btn-sm btn-neutral btn-round btn-icon" data-toggle="tooltip" data-original-title="Edit product">
					<span class="btn-inner--icon"><i class="fas fa-user-edit"></i></span>
					<span class="btn-inner--text">Export</span>
				</a> --}}
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-4">
				<h4>Name: </h3><span>{{$survey->fname}} {{$survey->lname}}</span>
			</div>
			<div class="col-4">
				<h4>Email: </h3><span>{{$survey->email}}</span>
			</div>
			<div class="col-4">
				<h4>Contact: </h3><span>{{$survey->phone}}</span>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="accordion" id="accordionExample">
			@foreach($survey->survey as $key => $s)
		    <div class="card">
		        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
		            <h5 class="mb-0">{{$s['Q']}}</h5>
		        </div>
		        <div id="collapse{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
		            <div class="card-body">
		            <p>{{$s['A']}}</p>
		            </div>
		        </div>
		  	</div>
		  	@endforeach
		</div>
	</div>
</div>


@endsection
