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
							<tr data-employee-id="{{ $item->id }}">
								<td>{{ $loop->iteration }}</td>
								<td data-first_name="{{ $item->first_name }}">
									{{ $item->first_name }}
								</td>
								<td data-middle_name="{{ $item->middle_name }}">
									{{ $item->middle_name }}
								</td>
								<td data-last_name="{{ $item->last_name }}">
									{{ $item->last_name }}
								</td>
								<td data-gender="{{ $item->gender }}">
									{{ ucfirst($item->gender) }}
								</td>
								@php 
									$salary = $item->salary()->pluck('salary')->first()
								@endphp
								<td data-salary="{{ $salary }}">{{ $salary }}</td>
								@php
									$d = $item->departments->mapWithKeys(function ($i) {
										return [$i['id'] => $i['name']];
									});
								@endphp
								<td data-departments="{{implode(',', array_keys($d->all()))}}">
									{{ 
										implode(', ', array_values($d->all()))
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