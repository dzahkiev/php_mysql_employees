@extends('layouts.main')

@section('content')
    <div class="card">
        <h4 class="card-header">
            Departments & Employees
        </h4>
        <div class="card-body">
           	<table class="table table-condensed table-hover" border=0>
           		<thead>
           			<th width="30%"></th>
           			@foreach ($departments->all() as $department)
           				<th>{{ $department }}</th>
           			@endforeach
           		</thead>
           		<tbody>
				@foreach ($employees as $employee)
					<tr>
						<td>{{ $employee->name }}</td>
						@foreach (array_keys($departments->all()) as $department)
							<td>
								@if (preg_match("/(^|,)${department}(,|$)/", $employee->departments))
									<i class="text-success fa fa-check"></i>
								@endif
							</td>
						@endforeach
					</tr>
				@endforeach
           		</tbody>
           	</table>
        </div>
    </div>
@endsection