@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header border-0">
		<div class="row">
			<div class="col-6">
				<h3 class="mb-0">Surveys</h3>
			</div>
			<div class="col-6 text-right">
				{{-- <a href="#" class="btn btn-sm btn-neutral btn-round btn-icon" data-toggle="tooltip" data-original-title="Edit product">
					<span class="btn-inner--icon"><i class="fas fa-user-edit"></i></span>
					<span class="btn-inner--text">Export</span>
				</a> --}}
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table align-items-center table-flush">
			<thead class="thead-light">
				<tr>
					<th>S.No</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1; @endphp
				@foreach($surveys as $survey)
					<tr>
						<td>{{$i++}}</td>
						<td>{{$survey->fname}} {{$survey->lname}}</td>
						<td>{{$survey->phone}}</td>
						<td>{{$survey->email}}</td>
						<td class="table-actions">
							<a href="{{url('/surveys/'.$survey->id)}}" class="table-action" data-toggle="tooltip" data-original-title="View Survey">
								<i class="fas fa-eye"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="card-footer py-4">
      {{ $surveys->links() }}
    </div>
</div>


@endsection
