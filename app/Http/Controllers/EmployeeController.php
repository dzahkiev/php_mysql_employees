<?php

namespace App\Http\Controllers;
use Log;
use Validator;
use App\Employee;
use App\Department;
use App\Salary;
use App\DepartmentEmployee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function list () {
    	return view('employee.list', [
    		'list' => Employee::all(),
            'departments' => Department::all(),
    	]);
    }

    public function add (Request $request) {
        Validator::make($request->all(), [
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'middle_name' => 'max:255',
            'gender'      => 'nullable|in:male,female',
            'salary'      => 'nullable|numeric',
            'departments' => 'required|min:1',
        ])->validate();

        $employee = new Employee;
        $employee
            ->fill($request->only($employee->getFillable()))
            ->save();

        Salary::create(array(
            'employee_id' => $employee->id,
            'salary'      => $request->salary
        ));

        foreach ($request->departments as $department_id) {
            DepartmentEmployee::create(array(
                'employee_id'   => $employee->id,
                'department_id' => $department_id
            ));
        }

    	return response()->json(array(
            'status' => 'success',
        ));
    }

     public function edit (Request $request) {
        dd($request);
    	return "employee/edit";
    }

    public function remove (Employee $employee) {
        // связанные данные из таблиц dapertment_employee и salary будут удалены каскадно
        $employee->delete();
        
        return response()->json(array(
            'status' => 'success',
        ));
    }

}
