<?php

namespace App\Http\Controllers;
use Log;
use App\Employee;
use App\Department;
use App\Salary;
use App\DepartmentEmployee;
use Illuminate\Http\Request;
use App\Http\Requests\AddOrEditEmployeeRequst;

class EmployeeController extends Controller
{
    public function list () {
    	return view('employee.list', [
    		'list' => Employee::all(),
            'departments' => Department::all(),
    	]);
    }

    public function add (AddOrEditEmployeeRequst $request) {
        $employee = new Employee;
        $employee
            ->fill($request->only($employee->getFillable()))
            ->save();

        Salary::create(array(
            'employee_id' => $employee->id,
            'salary'      => empty($request->salary) ? 0 : $request->salary,
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

     public function edit (AddOrEditEmployeeRequst $request, Employee $employee) {
        $employee
            ->fill($request->only($employee->getFillable()))
            ->save();

        Salary::where('employee_id', '=', $employee->id)
            ->update(['salary' => $request->salary]);

        DepartmentEmployee::where('employee_id', '=', $employee->id)->delete();

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

    public function remove (Employee $employee) {
        // связанные данные из таблиц dapertment_employee и salary будут удалены каскадно
        $employee->delete();
        
        return response()->json(array(
            'status' => 'success',
        ));
    }

}
