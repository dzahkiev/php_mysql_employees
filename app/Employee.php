<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employee";
    protected $fillable = ['first_name', 'last_name', 'middle_name', 'gender', ];

    public function departments()
    {
        return $this->belongsToMany(
                'App\Department',
                'department_employee',
                'employee_id',
                'department_id'
            );
    }

    public function salary()
    {
        return $this->hasOne(
                'App\Salary',
                'employee_id'
            );
    }
}
