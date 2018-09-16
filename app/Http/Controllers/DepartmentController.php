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

     public function edit () {
    	return "department/edit";
    }

}
