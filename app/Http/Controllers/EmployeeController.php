<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function list () {
    	return "employee/list";
    }

    public function add () {
    	return "employee/add";
    }

     public function edit () {
    	return "employee/edit";
    }

}
