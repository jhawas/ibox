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

Route::resource('medicineStocks', 'MedicineStockController');

// patient Informations
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

Route::get('patientInformations/{user}/edit', 'PatientInformationController@edit')
		->name('patientInformations.edit');

// diagnoses
Route::get('diagnoses', 'DiagnoseController@index')
		->name('diagnoses.index');

Route::post('diagnoses', 'DiagnoseController@store')
		->name('diagnoses.store');

Route::get('diagnoses/create', 'DiagnoseController@create')
		->name('diagnoses.create');

Route::get('diagnoses/{diagnose}', 'DiagnoseController@show')
		->name('diagnoses.show');

Route::put('diagnoses/{diagnose}', 'DiagnoseController@update')
		->name('diagnoses.update');

Route::delete('diagnoses/{diagnose}', 'DiagnoseController@destroy')
		->name('diagnoses.destroy');

Route::get('diagnoses/{diagnose}/edit', 'DiagnoseController@edit')
		->name('diagnoses.edit');

// Laboratory Test
Route::get('typeOfLaboratoryTests', 'TypeOfTestController@index')
		->name('typeOfTests.index');

Route::post('typeOfLaboratoryTests', 'TypeOfTestController@store')
		->name('typeOfTests.store');

Route::get('typeOfLaboratoryTests/create', 'TypeOfTestController@create')
		->name('typeOfTests.create');

Route::get('typeOfLaboratoryTests/{typeOfTest}', 'TypeOfTestController@show')
		->name('typeOfTests.show');

Route::put('typeOfLaboratoryTests/{typeOfTest}', 'TypeOfTestController@update')
		->name('typeOfTests.update');

Route::delete('typeOfLaboratoryTests/{typeOfTest}', 'TypeOfTestController@destroy')
		->name('typeOfTests.destroy');

Route::get('typeOfLaboratoryTests/{typeOfTest}/edit', 'TypeOfTestController@edit')
		->name('typeOfTests.edit');


// records types
Route::resource('recordTypes', 'RecordTypeController');

Route::resource('typeOfCharges', 'TypeOfChargeController');

Route::resource('patientStatementOfAccounts', 'PatientStatementOfAccountController');

Route::resource('patientRecords', 'PatientRecordController');

Route::resource('laboratoryTests', 'LaboratoryTestController');