<?php

namespace App\Http\Controllers\API;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $patients = Patient::with([
        	'records' => function($record) {
        		$record->with([
        			'recordType',
        			'diagnoses' => function($diagnose){
        				$diagnose->with(['diagnose']);
        			},
        			'vitalSigns',
        			'doctorsOrders' => function($doc) {
        				$doc->with(['user']);
        			},
        			'nursesNotes'=> function($nurse) {
        				$nurse->with(['user']);
        			},
        			'intravenousFluids' => function($nurse) {
        				$nurse->with(['user']);
        			},
        			'medicationAndTreatments',
        			'laboratory' => function($lab) {
        				$lab->with(['laboratory']);
        			},
        		])->where('discharged', 0);
        	}
        ])->get();
        return $patients;
    }

    public function delete($id = null) {
    	$patient = Patient::where('id', $id)->first();
        $patient->delete();
        return 'success';
    }

    public function edit($id) {
    	$patient = Patient::where('id', $id)->first();
        return $patient;
    }

    public function update(Request $request, $id = null) {
    	$patient = Patient::where('id', $id)->first();
    	$patient->first_name = $request->first_name;
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->suffix = $request->suffix;
        $patient->birthdate = $request->birthdate;
        $patient->sex = $request->sex;
        $patient->religion = $request->religion;
        $patient->address = $request->address;
        $patient->spouse = $request->spouse;
        $patient->spouse_address = $request->spouse_address;
        $patient->mother = $request->mother;
        $patient->father = $request->father;
        $patient->e_name = $request->e_name;
        $patient->e_contact = $request->e_contact;
        $patient->e_address = $request->e_address;
        $patient->civil_status = $request->civil_status;
        $patient->save();
        return 'success';
    }

    public function store(Request $request) {

    	$patient = new Patient;
    	$patient->first_name = $request->first_name;
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->suffix = $request->suffix;
        $tient->birthdate = $request->birthdate;
        $patient->sex = $request->sex;
        $patient->religion = $request->religion;
        $patient->address = $request->address;
        $patient->spouse = $request->spouse;
        $patient->spouse_address = $request->spouse_address;
        $patient->mother = $request->mother;
        $patient->father = $request->father;
        $patient->e_name = $request->e_name;
        $patient->e_contact = $request->e_contact;
        $patient->e_address = $request->e_address;
        $patient->civil_status = $request->civil_status;
        $patient->save();
        return 'success';
    }
}
