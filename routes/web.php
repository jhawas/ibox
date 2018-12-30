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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('rooms', 'RoomController');

Route::resource('floors', 'FloorController');

Route::resource('roomTypes', 'RoomTypeController');

Route::resource('medicineTypes', 'MedicineTypeController');

Route::resource('massVolumeTypes', 'MassVolumeTypeController');

Route::resource('medicineStocks', 'MedicineStockController');

Route::get('patientInformations', 'PatientInformationController@index')
		->name('patientInformations.index');

Route::post('patientInformations', 'PatientInformationController@store')
		->name('patientInformations.store');

Route::get('patientInformations/create', 'PatientInformationController@create')
		->name('patientInformations.create');

Route::get('patientInformations/{user}', 'PatientInformationController@show')
		->name('patientInformations.show');

Route::put('patientInformations/{user}', 'PatientInformationController@update')
		->name('patientInformations.update');

Route::delete('patientInformations/{user}', 'PatientInformationController@destroy')
		->name('patientInformations.destroy');

Route::delete('patientInformations/{user}/edit', 'PatientInformationController@edit')
		->name('patientInformations.edit');

