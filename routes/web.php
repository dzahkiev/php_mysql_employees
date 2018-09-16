<?php

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/department', 'DepartmentController@list')->name('department_list');
Route::any('/department/add', 'DepartmentController@add');
Route::get('/department/{id}/edit', 'DepartmentController@edit');
Route::get('/employee', 'EmployeeController@list')->name('employee_list');
Route::get('/employee/add', 'EmployeeController@add');
Route::get('/employee/{id}/edit', 'EmployeeController@edit');



