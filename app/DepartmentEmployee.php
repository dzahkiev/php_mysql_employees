<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentEmployee extends Model
{
    protected $table = "department_employee";
    protected $fillable = ['department_id', 'employee_id'];
    public $timestamps = false;
}
