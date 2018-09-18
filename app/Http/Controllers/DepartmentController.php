<?php

namespace App\Http\Controllers;

use Validator; 
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function list () {
    	return view('department.list', [
    		'list' => Department::all()
    	]);
    }

    public function add (Request $request) {
        Validator::make($request->all(), [
            'name' => 'required|unique:department|max:255',
        ])->validate();

        $department = new Department;
        $department->name = $request->name;
        $department->save();

        return response()->json(array(
            'status' => 'success',
        ));
    }

    public function edit (Request $request, Department $department) {
        Validator::make($request->all(), [
            'name' => 'required|max:255|unique:department,name,' . $department->id,
        ])->validate();

        $department->name = $request->name;
        $department->save();

        return response()->json(array(
            'status' => 'success',
        ));
    }

    public function remove (Request $request, Department $department) {
        if ($department->employeesCount() === 0) {
            $department->delete();
        }
        
        return response()->json(array(
            'status' => 'success',
        ));
    }

}
