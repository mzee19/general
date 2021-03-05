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
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=> '/form-field'], function() {
    Route::get('/','FormFieldController@index')->name('formFieldIndex');
    Route::get('/create','FormFieldController@create')->name('formFieldCreate');
    Route::post('/store','FormFieldController@store')->name('formFieldStore');

    Route::group(['prefix' => '{formField}'], function() {
        Route::get('/edit', 'FormFieldController@edit')->name('formFieldEdit');
        Route::put('/update', 'FormFieldController@update')->name('formFieldUpdate');
        Route::get('/delete', 'FormFieldController@destroy')->name('formFieldDelete');
    });
});

Route::group(['prefix'=> '/employee'], function() {
    Route::get('/','EmployeeController@index')->name('employeeIndex');
    Route::get('/create','EmployeeController@create')->name('employeeCreate');
    Route::post('/store','EmployeeController@store')->name('employeeStore');

    Route::group(['prefix' => '{employee}'], function() {
        Route::get('/edit', 'EmployeeController@edit')->name('employeeEdit');
        Route::put('/update', 'EmployeeController@update')->name('employeeUpdate');
        Route::get('/delete', 'EmployeeController@destroy')->name('employeeDelete');
    });
});