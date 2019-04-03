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
Route::get('doctorsOrders', 'API\DoctorsOrderController@all');
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

// patient laboratory
Route::get('patientLaboratories/{patient_record_id}', 'API\PatientLaboratoryController@data');
Route::delete('patientLaboratories/{patient_record_id}', 'API\PatientLaboratoryController@delete');
Route::post('patientLaboratories', 'API\PatientLaboratoryController@store');
Route::get('patientLaboratories/{id}/edit', 'API\PatientLaboratoryController@edit');
Route::put('patientLaboratories/{id}', 'API\PatientLaboratoryController@update');

//diagnoses
Route::get('diagnoses', 'API\DiagnosesController@data');
Route::delete('diagnoses/{id}', 'API\DiagnosesController@delete');
Route::post('diagnoses', 'API\DiagnosesController@store');
Route::get('diagnoses/{id}/edit', 'API\DiagnosesController@edit');
Route::put('diagnoses/{id}', 'API\DiagnosesController@update');

// results
Route::get('results', 'API\ResultController@data');
Route::delete('results/{id}', 'API\ResultController@delete');
Route::post('results', 'API\ResultController@store');
Route::get('results/{id}/edit', 'API\ResultController@edit');
Route::put('results/{id}', 'API\ResultController@update');

// philhealth membership
Route::get('philhealthMemberShip', 'API\PhilhealthMemberShipController@data');
Route::delete('philhealthMemberShip/{id}', 'API\PhilhealthMemberShipController@delete');
Route::post('philhealthMemberShip', 'API\PhilhealthMemberShipController@store');
Route::get('philhealthMemberShip/{id}/edit', 'API\PhilhealthMemberShipController@edit');
Route::put('philhealthMemberShip/{id}', 'API\PhilhealthMemberShipController@update');

// disposition
Route::get('dispositions', 'API\DispositionController@data');
Route::delete('dispositions/{id}', 'API\DispositionController@delete');
Route::post('dispositions', 'API\DispositionController@store');
Route::get('dispositions/{id}/edit', 'API\DispositionController@edit');
Route::put('dispositions/{id}', 'API\DispositionController@update');

// records
Route::get('records', 'API\RecordController@data');
Route::get('records/{type_of_record_id}', 'API\RecordController@dataByRecordType');
Route::delete('records/{id}', 'API\RecordController@delete');
Route::post('records', 'API\RecordController@store');
Route::get('records/{id}/edit', 'API\RecordController@edit');
Route::put('records/{id}', 'API\RecordController@update');

//type of charge
Route::get('typeOfCharges', 'API\TypeOfChargeController@data');
Route::get('typeOfChargesDataWithNoParent', 'API\TypeOfChargeController@dataWithNoParent');
Route::delete('typeOfCharges/{id}', 'API\TypeOfChargeController@delete');
Route::post('typeOfCharges', 'API\TypeOfChargeController@store');
Route::get('typeOfCharges/{id}/edit', 'API\TypeOfChargeController@edit');
Route::put('typeOfCharges/{id}', 'API\TypeOfChargeController@update');

//room
Route::get('rooms', 'API\RoomController@data');
Route::delete('rooms/{id}', 'API\RoomController@delete');
Route::post('rooms', 'API\RoomController@store');
Route::get('rooms/{id}/edit', 'API\RoomController@edit');
Route::put('rooms/{id}', 'API\RoomController@update');

//room
Route::get('floors', 'API\FloorController@data');
Route::delete('floors/{id}', 'API\FloorController@delete');
Route::post('floors', 'API\FloorController@store');
Route::get('floors/{id}/edit', 'API\FloorController@edit');
Route::put('floors/{id}', 'API\FloorController@update');

//users
Route::get('users', 'API\UserController@data');
Route::delete('users/{id}', 'API\UserController@delete');
Route::post('users', 'API\UserController@store');
Route::get('users/{id}/edit', 'API\UserController@edit');
Route::put('users/{id}', 'API\UserController@update');

// insurances
Route::get('insurances', 'API\InsuranceController@data');
Route::delete('insurances/{id}', 'API\InsuranceController@delete');
Route::post('insurances', 'API\InsuranceController@store');
Route::get('insurances/{id}/edit', 'API\InsuranceController@edit');
Route::put('insurances/{id}', 'API\InsuranceController@update');

//users
Route::get('typeOfRecords', 'API\TypeOfRecordController@data');

Route::get('typeOfOrders', 'API\TypeOfOrderController@data');

Route::get('typeOfLaboratories', 'API\TypeOfLaboratoryController@data');

