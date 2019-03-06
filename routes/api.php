<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('patientRecords', 'API\BillingController@patientRecords');

Route::get('billing/patientRecord/{patient_record_id}', 'API\BillingController@billing');

Route::post('billing', 'API\BillingController@storeBilling');

Route::get('billing/charges', 'API\BillingController@charges');

Route::delete('billing/removed/{id}', 'API\BillingController@removedBill');

Route::get('billing/total/{patient_record_id}', 'API\BillingController@getTotalBill');

Route::post('billing/payment', 'API\BillingController@storePayment');

Route::get('billing/status/{patient_record_id}', 'API\BillingController@getPaymentStatus');

Route::get('payment/{patient_record_id}', 'API\BillingController@getPayment');


// patient
Route::get('patients', 'API\PatientController@data');
Route::delete('patients/{id}', 'API\PatientController@delete');
Route::post('patients', 'API\PatientController@store');
Route::get('patients/{id}/edit', 'API\PatientController@edit');
Route::put('patients/{id}', 'API\PatientController@update');


// vital signs
Route::get('vitalSigns/{patient_record_id}', 'API\VitalSignController@data');
Route::delete('vitalSigns/{patient_record_id}', 'API\VitalSignController@delete');
Route::post('vitalSigns', 'API\VitalSignController@store');
Route::get('vitalSigns/{id}/edit', 'API\VitalSignController@edit');
Route::put('vitalSigns/{id}', 'API\VitalSignController@update');

// doctors orders
Route::get('doctorsOrders/{patient_record_id}', 'API\DoctorsOrderController@data');
Route::delete('doctorsOrders/{patient_record_id}', 'API\DoctorsOrderController@delete');
Route::post('doctorsOrders', 'API\DoctorsOrderController@store');
Route::get('doctorsOrders/{id}/edit', 'API\DoctorsOrderController@edit');
Route::put('doctorsOrders/{id}', 'API\DoctorsOrderController@update');

// nurses notes
Route::get('nursesNotes/{patient_record_id}', 'API\NursesNoteController@data');
Route::delete('nursesNotes/{patient_record_id}', 'API\NursesNoteController@delete');
Route::post('nursesNotes', 'API\NursesNoteController@store');
Route::get('nursesNotes/{id}/edit', 'API\NursesNoteController@edit');
Route::put('nursesNotes/{id}', 'API\NursesNoteController@update');

// Intravenous Fluid
Route::get('intravenousFluids/{patient_record_id}', 'API\IntravenousFluidController@data');
Route::delete('intravenousFluids/{patient_record_id}', 'API\IntravenousFluidController@delete');
Route::post('intravenousFluids', 'API\IntravenousFluidController@store');
Route::get('intravenousFluids/{id}/edit', 'API\IntravenousFluidController@edit');
Route::put('intravenousFluids/{id}', 'API\IntravenousFluidController@update');

// Medication And Treatments
Route::get('medicationAndTreatments/{patient_record_id}', 'API\MedicationAndTreatmentController@data');
Route::delete('medicationAndTreatments/{patient_record_id}', 'API\MedicationAndTreatmentController@delete');
Route::post('medicationAndTreatments', 'API\MedicationAndTreatmentController@store');
Route::get('medicationAndTreatments/{id}/edit', 'API\MedicationAndTreatmentController@edit');
Route::put('medicationAndTreatments/{id}', 'API\MedicationAndTreatmentController@update');


// patient diagnoses
Route::get('patientDiagnoses/{patient_record_id}', 'API\PatientDiagnosesController@data');
Route::delete('patientDiagnoses/{patient_record_id}', 'API\PatientDiagnosesController@delete');
Route::post('patientDiagnoses', 'API\PatientDiagnosesController@store');
Route::get('patientDiagnoses/{id}/edit', 'API\PatientDiagnosesController@edit');
Route::put('patientDiagnoses/{id}', 'API\PatientDiagnosesController@update');

//diagnoses
Route::get('diagnoses', 'API\DiagnosesController@data');
Route::delete('diagnoses/{id}', 'API\DiagnosesController@delete');
Route::post('diagnoses', 'API\DiagnosesController@store');
Route::get('diagnoses/{id}/edit', 'API\DiagnosesController@edit');
Route::put('diagnoses/{id}', 'API\DiagnosesController@update');