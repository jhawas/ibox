<?php

namespace App\Http\Controllers\API;

use App\LaboratoryTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientLaboratoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $laboratoryTests = LaboratoryTest::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	},
        	'laboratory'
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return response()->json($laboratoryTests);
    }

    public function delete($id = null) {
    	$laboratoryTest = LaboratoryTest::where('id', $id)->first();
        $laboratoryTest->delete();
        return 'success';
    }

    public function edit($id) {
    	$laboratoryTest = LaboratoryTest::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	},
        	'laboratory'
        ])->where('id', $id)->first();
        return $laboratoryTest;
    }

    public function update(Request $request, $id = null) {
    	$laboratoryTest = LaboratoryTest::where('id', $id)->first();
    	$laboratoryTest->patient_record_id = $request->patient_record_id;
        $laboratoryTest->diagnose_id = $request->diagnose_id;
        $laboratoryTest->diagnoses = $request->diagnoses;
        $laboratoryTest->remarks = $request->remarks;
        $laboratoryTest->save();
        return 'success';
    }

    public function store(Request $request) {
    	$laboratoryTest = new LaboratoryTest;
        $laboratoryTest->patient_record_id = $request->patient_record_id;
        $laboratoryTest->diagnose_id = $request->diagnose_id;
        $laboratoryTest->diagnoses = $request->diagnoses;
        $laboratoryTest->remarks = $request->remarks;
        $laboratoryTest->save();
        return 'success';
    }
}