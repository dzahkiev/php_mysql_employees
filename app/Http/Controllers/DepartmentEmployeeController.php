<?php

namespace App\Http\Controllers;

use Log;
use DB;
use App\Department;
use App\Employee;
use Illuminate\Http\Request;

class DepartmentEmployeeController extends Controller
{
    public function list () {
    	$departments = Department::all()->mapWithKeys(function ($i) {
			return [$i['id'] => $i['name']];
		});
    	$employees = DB::select("
    		select
				concat_ws(' ', e.first_name, e.middle_name, last_name) as name, 
				group_concat(d.id) as departments
			from employee e
			left join department_employee de on de.employee_id = e.id
			left join department d on d.id = de.department_id
			group by e.id;
		");

		return view('index', [
			'employees'   => $employees,
			'departments' => $departments,
		]);
    }
}


