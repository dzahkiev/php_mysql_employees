<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function list () {
    	return view('employee.list', [
    		'list' => Employee::all()
    	]);
    }

    public function add () {
    	return "employee/add";
    }

     public function edit () {
    	return "employee/edit";
    }

}
