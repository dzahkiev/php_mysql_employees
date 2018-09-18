<?php

namespace App;

use App\DepartmentEmployee;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "department";

    public function employeesCount() {
        return $this->hasMany(DepartmentEmployee::class)->count();
    }
}
