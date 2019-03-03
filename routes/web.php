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

Route::get('billing', 'BillingController@index')->name('billing.index');

Route::resource('users', 'UserController');

Route::resource('rooms', 'RoomController');

Route::resource('floors', 'FloorController');

Route::resource('roomTypes', 'RoomTypeController');

Route::resource('medicineTypes', 'MedicineTypeController');

Route::resource('medicineStocks', 'MedicineStockController');

Route::resource('patients', 'PatientController');

Route::resource('vitalSigns', 'VitalSignController');

Route::resource('doctorsOrders', 'DoctorsOrderController');

Route::resource('nursesNotes', 'NursesNoteController');

Route::resource('intravenousFluids', 'IntravenousFluidController');

Route::resource('medicationAndTreatments', 'MedicationAndTreatmentController');

Route::get('patients/patients/print', 'PatientController@print')
		->name('patients.print');

Route::get('patients/{patient}/print', 'PatientController@printHistory')
		->name('patients.printHistory');

// cashier
Route::get('selection', 'CashierController@selection')
		->name('cashiers.selection');
Route::post('selection', 'CashierController@storeSelection')
		->name('cashiers.storeSelection');

Route::get('cashiers/{patientRecord}', 'CashierController@index')
		->name('cashiers.index');

Route::post('cashiers/{patientRecord}/store', 'CashierController@store')
		->name('cashiers.store');

Route::get('cashiers/{cashier}/print', 'CashierController@print')
		->name('cashiers.print');

Route::get('medicineStocks/inventory/print', 'MedicineStockController@print')
		->name('medicineStocks.print');

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

Route::resource('patientRecords', 'PatientRecordController');

Route::resource('laboratoryTests', 'LaboratoryTestController');


Route::resource('inPatients', 'InPatientController');

Route::resource('outPatients', 'OutPatientController');

// billing
Route::get('patientBillings/{patientRecord}', 'PatientBillingController@index')
		->name('patientBillings.index');

Route::get('patientBillings/{patientRecord}/create', 'PatientBillingController@create')
		->name('patientBillings.create');

Route::post('patientBillings/{patientRecord}/store', 'PatientBillingController@store')
		->name('patientBillings.store');

Route::get('patientBillings/{patientRecord}/{patientBilling}/edit', 'PatientBillingController@edit')
		->name('patientBillings.edit');

Route::put('patientBillings/{patientRecord}/{patientBilling}', 'PatientBillingController@update')
		->name('patientBillings.update');

Route::delete('patientBillings/{patientRecord}/{patientBilling}', 'PatientBillingController@destroy')
		->name('patientBillings.destroy');

Route::get('patientBillings/{patientRecord}/print', 'PatientBillingController@print')
		->name('patientBillings.print');

// patient diagnoses
Route::get('patientDiagnoses/{patientRecord}', 'PatientDiagnoseController@index')
		->name('patientDiagnoses.index');

Route::get('patientDiagnoses/{patientRecord}/create', 'PatientDiagnoseController@create')
		->name('patientDiagnoses.create');

Route::post('patientDiagnoses/{patientRecord}/store', 'PatientDiagnoseController@store')
		->name('patientDiagnoses.store');

Route::get('patientDiagnoses/{patientRecord}/{patientDiagnose}/edit', 'PatientDiagnoseController@edit')
		->name('patientDiagnoses.edit');

Route::put('patientDiagnoses/{patientRecord}/{patientDiagnose}', 'PatientDiagnoseController@update')
		->name('patientDiagnoses.update');

Route::delete('patientDiagnoses/{patientRecord}/{patientDiagnose}', 'PatientDiagnoseController@destroy')
		->name('patientDiagnoses.destroy');

// print

Route::get('print/{patient_record_id}/billing', 'PrintController@printBilling')
		->name('print.printBilling');