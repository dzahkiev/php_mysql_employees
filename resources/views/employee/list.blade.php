@extends('layouts.main')

@section('content')
	<div class="card">
		<h4 class="card-header">
			Employees
			<i id="addEmployee" class="btn btn-success fa fa-plus"></i>
		</h4>
		<div class="card-body">
			@if(count($list))
				<table class="table table-condensed table-hover">
					<thead>
						<th>#</th>
						<th>First name</th>
						<th>Middle name</th>
						<th>Last name</th>
						<th>Gender</th>
						<th>Salary</th>
						<th>Departments</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($list as $item)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $item->first_name }}</td>
								<td>{{ $item->middle_name }}</td>
								<td>{{ $item->last_name }}</td>
								<td>{{ $item->gender }}</td>
								<td>{{ $item->salary()->pluck('salary')->first() }}</td>
								<td>
									{{ 
										implode(', ',
											$item->departments()->pluck('name')->toArray()
										)
									}}
								</td>
								<td>
									<i class="btn btn-primary fa fa-pencil editEmployee"></i>
									<i class="btn btn-danger fa fa-trash removeEmployee"></i>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				No data
			@endif
		</div>
		@include('layouts.modal_employee')
	</div>
@endsection