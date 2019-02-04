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