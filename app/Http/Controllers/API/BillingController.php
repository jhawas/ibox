<?php

namespace App\Http\Controllers\API;

use App\PatientRecord;
use App\TypeOfCharge;
use App\PatientBilling;
use App\Cashier;
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
        $patientRecords = PatientRecord::with(['patient', 'billings'])->where('discharged', 0)->get();
        return $patientRecords;
    }

    public function billingPatientRecords()
    {
        $patientRecords = PatientRecord::with(['patient', 'billings'])->where('is_final_discharged', 0)->get();
        return $patientRecords;
    }

    public function charges()
    {
        $typeOfCharges = TypeOfCharge::with([
            'parent'
        ])->where('price', '>', 0)->get();
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
        $patientBilling->phic = $request->phic;
        $patientBilling->insurance_id = $request->insurance;
        $patientBilling->hmo = $request->insuranceAmount;
        $patientBilling->discount = $request->insuranceAmount;
        $patientBilling->save();
        return 'success';
    }

    public function removedBill($billing_id = null) {
        $patientBilling = PatientBilling::where('id', $billing_id)->first();
        $patientBilling->delete();
        return 'success';
    }

    public function getTotalBill($patient_record_id = null) {
        $total = PatientBilling::where('patient_record_id', $patient_record_id)
        ->get()->sum('total');
        $phic = PatientBilling::where('patient_record_id', $patient_record_id)
        ->get()->sum('phic');
        $discount = PatientBilling::where('patient_record_id', $patient_record_id)
        ->get()->sum('discount');
        $hmo = PatientBilling::where('patient_record_id', $patient_record_id)
        ->get()->sum('hmo');
        return [
            'total' => $total,
            'phic' => $phic,
            'discount' => $discount,
            'hmo' => $hmo,
            'excess' => $total - ($phic + $discount + $hmo),
        ];
    }

    public function storePayment(Request $request) {
        $payment = new Cashier;
        $payment->patient_record_id = $request->patient_record_id;
        $payment->total = $request->totalBill;
        $payment->amount = $request->enteredAmount;
        $payment->change = $request->change;
        $payment->save();

        $patientRecord = PatientRecord::where('id', $request->patient_record_id)->first();
        // $patientRecord->discharged = 1;
        $patientRecord->save();

        return 'success';
    }

    public function getPaymentStatus($patient_record_id = null) {
        $patientRecord = PatientRecord::where('id', $request->patient_record_id)->first();
        return $patientRecord;
    }

    public function getPayment($patient_record_id = null) {
        // return $patient_record_id;
        $cashier = Cashier::where('patient_record_id', $patient_record_id)->get();
        return $cashier;
    } 
}
