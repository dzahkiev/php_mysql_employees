<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeProcedure extends Migration
{

    public function up()
    {
        DB::unprepared("
            CREATE PROCEDURE `add_new_employee`(
                IN `strFirstName` VARCHAR(255),
                IN `strLastName` VARCHAR(255),
                IN `strMiddleName` VARCHAR(255),
                IN `strGender` varchar(255),
                IN `intSalary` INT,
                IN `intDepartmentId` INT
            )
            BEGIN
                DECLARE departmentCount INT;
                DECLARE newEmployeeId INT;
                
                select count(*) into departmentCount from department where id=intDepartmentId;

                IF departmentCount THEN
                    START TRANSACTION;
                        insert into employee
                        set
                            first_name=strFirstName,
                            last_name=strLastName,
                            middle_name=strMiddleName,
                            gender=strGender
                        ;

                        SET newEmployeeId=LAST_INSERT_ID();

                        insert into salary
                        set
                            salary.salary=intSalary,
                            salary.employee_id=newEmployeeId
                        ;

                        insert into department_employee
                        set
                            department_id=intDepartmentId,
                            employee_id=newEmployeeId
                        ;
                        select 1;
                    COMMIT;
                END IF; 
            END
        ");
        
    }

    public function down()
    {
        DB::unprepared("drop procedure if exists add_new_employee");        
    }
}
