<?php

namespace App\Http\Controllers;

use App\Employee;
use Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function list () {
    	return view('employee.list', [
    		'list' => Employee::all()
    	]);
    }

    public function add (Request $request) {
        Validator::make($request->all(), [
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'middle_name' => 'max:255',
            'gender'      => 'in:male,female',
            'salary'      => 'numeric',
            'departments' => 'required|min:1',
        ])->validate();

        $employee = new Employee;
        $employee
            ->fill($request->only($employee->getFillable()))
            ->save();

        // foreach ($request->departments as $department_id) {
            
        // }

    	return response()->json(array(
            'status' => 'success',
        ));
    }

     public function edit (Request $request) {
        dd($request);
    	return "employee/edit";
    }

}
