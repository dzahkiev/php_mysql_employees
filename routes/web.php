<?php

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/department', 'DepartmentController@list')->name('department_list');
Route::post('/department/add', 'DepartmentController@add');
Route::post('/department/{id}/edit', 'DepartmentController@edit');
Route::post('/department/{id}/remove', 'DepartmentController@remove');
Route::get('/employee', 'EmployeeController@list')->name('employee_list');
Route::get('/employee/add', 'EmployeeController@add');
Route::get('/employee/{id}/edit', 'EmployeeController@edit');



