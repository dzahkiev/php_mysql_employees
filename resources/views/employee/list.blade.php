@extends('layouts.main')

@section('content')
	<div class="card">
		<h4 class="card-header">
			Employees
			<i class="btn btn-success fa fa-plus"></i>
		</h4>
		<div class="card-body">
			@if(count($list))
				<table class="table table-condensed">
					<thead>
						<th>#</th>
						<th>Name</th>
					</thead>
					<tbody>
						@foreach($list as $item)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $item->name }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				No data
			@endif
		</div>
@endsection