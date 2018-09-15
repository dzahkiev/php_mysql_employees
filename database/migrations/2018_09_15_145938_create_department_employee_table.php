<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentEmployeeTable extends Migration
{

    public function up()
    {
        Schema::create('department_employee', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('department_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->primary(array('department_id', 'employee_id'));
            // каскадное удалении значений из таблицы department_employee
            // при удалении записи из таблицы employee
            $table->foreign('employee_id')
                ->references('id')
                ->on('employee')
                ->onDelete('cascade')
                ->onUpdate('cascade')
            ;
            // запрет на удаление значений из таблицы department
            $table->foreign('department_id')
                ->references('id')
                ->on('department')
                ->onDelete('restrict')
                ->onUpdate('cascade')
            ;
        });
    }

    public function down()
    {
        Schema::dropIfExists('department_employee');
    }
}
