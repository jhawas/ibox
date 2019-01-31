<?php

namespace App\Http\Controllers\API;

use App\PatientRecord;
use App\PatientBilling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function patientRecords()
    {
        $patientRecords = PatientRecord::with(['patient', 'billings'])->get();
        return $patientRecords;
    }

    public function billing($patient_record_id = null) {
        $patientBilling = PatientBilling::where('patient_record_id', $patient_record_id)->get();
        return $patientBilling;
    }

    public function storeBilling(Request $request) {
        $patientBilling = new PatientBilling;
        $patientBilling->patient_record_id = $request->patient_record_id;
        $patientBilling->type_of_charge_id = $request->type_of_charge_id;
        $patientBilling->price = $request->price;
        $patientBilling->quantity = $request->quantity;
        $patientBilling->description = $request->description;
        $patientBilling->save();
        return 'success';
    }
}
