<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('companies.index');
});

//Route::get('companies/{id}/edit/delete','CompaniesController@destroyDiversity');


Route::delete('destroyDiversity/{id}', 'CompaniesController@destroyDiversity');


Route::resource('companies', 'CompaniesController');
Route::resource('employees', 'EmployeesController');

