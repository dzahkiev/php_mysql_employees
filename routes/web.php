<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/department', 'DepartmentController@list');
Route::get('/department/add', 'DepartmentController@add');
Route::get('/department/{id}/edit', 'DepartmentController@edit');
Route::get('/employee', 'EmployeeController@list');
Route::get('/employee/add', 'EmployeeController@add');
Route::get('/employee/{id}/edit', 'EmployeeController@edit');



