<?php

namespace App\Http\Controllers\API;

use App\PatientDiagnose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientDiagnosesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $patientDiagnoses = PatientDiagnose::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	},
        	'diagnose'
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return response()->json($patientDiagnoses);
    }

    public function delete($id = null) {
    	$patientDiagnose = PatientDiagnose::where('id', $id)->first();
        $patientDiagnose->delete();
        return 'success';
    }

    public function edit($id) {
    	$patientDiagnose = PatientDiagnose::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	},
        	'diagnose'
        ])->where('id', $id)->first();
        return $patientDiagnose;
    }

    public function update(Request $request, $id = null) {
    	$patientDiagnose = PatientDiagnose::where('id', $id)->first();
    	$patientDiagnose->patient_record_id = $request->patient_record_id;
        $patientDiagnose->diagnose_id = $request->diagnose_id;
        $patientDiagnose->diagnoses = $request->diagnoses;
        $patientDiagnose->remarks = $request->remarks;
        $patientDiagnose->save();
        return 'success';
    }

    public function store(Request $request) {
    	$patientDiagnose = new PatientDiagnose;
        $patientDiagnose->patient_record_id = $request->patient_record_id;
        $patientDiagnose->diagnose_id = $request->diagnose_id;
        $patientDiagnose->diagnoses = $request->diagnoses;
        $patientDiagnose->remarks = $request->remarks;
        $patientDiagnose->save();
        return 'success';
    }
}
