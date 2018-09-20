@extends('layouts.main')

@section('content')
	<div class="card">
		<h4 class="card-header">
			Departments
			<i id="addDepartment" class="btn btn-success fa fa-plus"></i>
		</h4>
		<div class="card-body">
			@if(count($list))
				<table class="table table-condensed table-hover">
					<thead>
						<th width="20%">#</th>
						<th width="70%">Name</th>
						<th width="10%"></th>
					</thead>
					<tbody>
						@foreach($list as $item)
							<tr data-department-id="{{$item->id}}">
								<td>{{ $loop->iteration }}</td>
								<td data-name="{{ $item->name }}">{{ $item->name }}</td>
								<td >
									<i class="btn btn-primary fa fa-pencil editDepartment"></i>
									<i class="btn btn-danger fa fa-trash removeDepartment"></i>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				No data
			@endif
		</div>
	</div>
	@include('layouts.modal_department')
@endsection