<?php

Route::get('/', 'DepartmentEmployeeController@list')->name('index');
Route::get('/department', 'DepartmentController@list')->name('department_list');
Route::post('/department/add', 'DepartmentController@add');
Route::post('/department/{department}/edit', 'DepartmentController@edit');
Route::post('/department/{department}/remove', 'DepartmentController@remove');
Route::get('/employee', 'EmployeeController@list')->name('employee_list');
Route::post('/employee/add', 'EmployeeController@add');
Route::post('/employee/{employee}/edit', 'EmployeeController@edit');
Route::post('/employee/{employee}/remove', 'EmployeeController@remove');



