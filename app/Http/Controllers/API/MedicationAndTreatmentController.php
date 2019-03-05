<?php

namespace App\Http\Controllers\API;

use App\MedicationAndTreatment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicationAndTreatmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $medicationAndTreatments = MedicationAndTreatment::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	}
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return $medicationAndTreatments;
    }

    public function delete($id = null) {
    	$medicationAndTreatment = MedicationAndTreatment::where('id', $id)->first();
        $medicationAndTreatment->delete();
        return 'success';
    }

    public function edit($id) {
    	$medicationAndTreatment = MedicationAndTreatment::where('id', $id)->first();
        return $medicationAndTreatment;
    }

    public function update(Request $request, $id = null) {
    	$medicationAndTreatment = MedicationAndTreatment::where('id', $id)->first();
    	$medicationAndTreatment->patient_record_id = $request->patient_record_id;
        $medicationAndTreatment->date = $request->date;
        $medicationAndTreatment->time = $request->time;
        $medicationAndTreatment->medicine = $request->medicine;
        $medicationAndTreatment->remarks = $request->remarks;
        $medicationAndTreatment->save();
        return 'success';
    }

    public function store(Request $request) {
    	$medicationAndTreatment = new MedicationAndTreatment;
        $medicationAndTreatment->patient_record_id = $request->patient_record_id;
        $medicationAndTreatment->date = $request->date;
        $medicationAndTreatment->time = $request->time;
        $medicationAndTreatment->medicine = $request->medicine;
        $medicationAndTreatment->remarks = $request->remarks;
        $medicationAndTreatment->save();
        return 'success';
    }
}
