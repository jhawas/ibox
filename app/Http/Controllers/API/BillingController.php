<?php

namespace App\Http\Controllers\API;

use App\PatientRecord;
use App\TypeOfCharge;
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

    public function charges()
    {
        $typeOfCharges = TypeOfCharge::all();
        return $typeOfCharges;
    }

    public function billing($patient_record_id = null) 
    {
        $patientBilling = PatientBilling::with([
            'charge'
        ])
        ->where('patient_record_id', $patient_record_id)
        ->get();
        return $patientBilling;
    }

    public function storeBilling(Request $request) {
        $patientBilling = new PatientBilling;
        $patientBilling->patient_record_id = $request->patient_record_id;
        $patientBilling->type_of_charge_id = $request->type_of_charge_id;
        $patientBilling->bill = $request->charge;
        $patientBilling->price = $request->price;
        $patientBilling->quantity = $request->quantity;
        $patientBilling->total = $request->total;
        $patientBilling->description = $request->description;
        $patientBilling->save();
        return 'success';
    }

    public function removedBill($billing_id = null) {
        $patientBilling = PatientBilling::where('id', $billing_id)->first();
        $patientBilling->delete();
        return 'success';
    }
}
