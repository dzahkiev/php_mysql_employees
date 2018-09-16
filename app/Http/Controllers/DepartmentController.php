<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function list () {
    	return "department/list";
    }

    public function add () {
    	return "department/add";
    }

     public function edit () {
    	return "department/edit";
    }

}
