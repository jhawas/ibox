<?php

namespace App\Http\Controllers\API;

use App\PatientRecord;
use App\PatientDiagnose;
use App\VitalSign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $records = PatientRecord::with([
            'patient', 
            'recordType',
            'physician',
            'admit_checkup_by',
            'discharged_by',
            'room' => function($query) {
                $query->with([
                    'room_type'
                ]);
            },
        ])->get();
        return $records;
    }

    public function dataByRecordType($type_of_record_id = null)
    {
        $records = PatientRecord::with([
            'patient', 
            'recordType',
            'physician',
            'admit_checkup_by',
            'discharged_by',
            'floor',
            'philhealthMembership',
            'result',
            'disposition',
            'chart_completed_by',
            'room' => function($query) {
                $query->with([
                    'room_type'
                ]);
            },
        ])->where('type_of_record_id', $type_of_record_id)->get();
        return $records;
    }


    public function delete($id = null) {
    	$record = PatientRecord::where('id', $id)->first();
        $record->delete();
        return 'success';
    }

    public function edit($id) {
    	$record = PatientRecord::with([
            'patient', 
            'recordType',
            'physician',
            'admit_checkup_by',
            'discharged_by',
            'floor',
            'philhealthMembership',
            'result',
            'disposition',
            'chart_completed_by',
            'room' => function($query) {
                $query->with([
                    'room_type'
                ]);
            },
        ])->where('id', $id)->first();
        
        $initial_diagnoses = PatientDiagnose::with([
        	'diagnose'
        ])->where('patient_record_id', $id)->first();
        $record->initial_diagnoses = $initial_diagnoses;
        return $record;
        // return response()->json([
        // 	'record' => $record,
        // 	'intial_diagnoses' => $intial_diagnoses
        // ]);
    }

    public function update(Request $request, $id = null) {
    	$record = PatientRecord::where('id', $id)->first();
    	$record->addmitted_and_check_up_date = $request->addmission_date;
		$record->admitted_and_check_up_by = $request->addmission_doctor;
		$record->addmitted_and_check_up_time = $request->addmission_time;
		$record->attending_physician = $request->attending_physician;
		$record->bed = $request->bed;
		$record->blood_pressure = $request->blood_pressure;
		$record->brief_history = $request->brief_history;
		$record->chief_complaints = $request->chief_complaints;
		$record->chart_completed_by = $request->completed_by;
		$record->discharge_date = $request->discharged_date;
		$record->discharge_by = $request->discharged_doctor;
		$record->discharge_time = $request->discharged_time;
		$record->disposition_id = $request->disposition;
		$record->floor_id = $request->floor;
		$record->height = $request->height;
		$record->patient_id = $request->patient;
		$record->philhealth_membership_id = $request->philhealthMemberShip;
		$record->pulse_rate = $request->pulse_rate;
		$record->result_id = $request->result;
		$record->room_id = $request->room;
		$record->sponsor = $request->sponsor;
		$record->temperature = $request->temperature;
		$record->type_of_record_id = $request->typeOfRecord;
		$record->weight = $request->weight;
		$record->discharged = empty($request->discharged) ? 0 : $request->discharged;
        $record->is_final_discharged = empty($request->is_final_discharged) ? 0 : $request->is_final_discharged;
		$record->save();

		if($request->diagnose) {
			$patientDiagnose = PatientDiagnose::where('patient_record_id', $id)->first();
	        $patientDiagnose->diagnose_id = $request->diagnose;
	        // $patientDiagnose->patient_record_id = $id;
	        $patientDiagnose->diagnoses = $request->diagnoses_description;
	        $patientDiagnose->remarks = $request->remarks;
	        $patientDiagnose->save();
		}

		$vitalSign = VitalSign::where('patient_record_id', $id)->first();
        // $vitalSign->patient_record_id = $record->id;
        $vitalSign->date = $request->addmission_date;
        $vitalSign->time = $request->addmission_time;
        $vitalSign->bp = $request->blood_pressure;
        $vitalSign->t = $request->temperature;
        $vitalSign->p = $request->pulse_rate;
        $vitalSign->save();
        return 'success';
    }

    public function store(Request $request) {
    	$record = new PatientRecord;
    	$record->addmitted_and_check_up_date = $request->addmission_date;
		$record->admitted_and_check_up_by = $request->addmission_doctor;
		$record->addmitted_and_check_up_time = $request->addmission_time;
		$record->attending_physician = $request->attending_physician;
		$record->bed = $request->bed;
		$record->blood_pressure = $request->blood_pressure;
		$record->brief_history = $request->brief_history;
		$record->chief_complaints = $request->chief_complaints;
		$record->chart_completed_by = $request->completed_by;
		$record->discharge_date = $request->discharged_date;
		$record->discharge_by = $request->discharged_doctor;
		$record->discharge_time = $request->discharged_time;
		$record->disposition_id = $request->disposition;
		$record->floor_id = $request->floor;
		$record->height = $request->height;
		$record->patient_id = $request->patient;
		$record->philhealth_membership_id = $request->philhealthMemberShip;
		$record->pulse_rate = $request->pulse_rate;
		$record->result_id = $request->result;
		$record->room_id = $request->room;
		$record->sponsor = $request->sponsor;
		$record->temperature = $request->temperature;
		$record->type_of_record_id = $request->typeOfRecord;
		$record->weight = $request->weight;
		$record->discharged = empty($request->discharged) ? 0 : $request->discharged;
        $record->is_final_discharged = empty($request->is_final_discharged) ? 0 : $request->is_final_discharged;
		$record->save();

		if($request->diagnose) {
			$patientDiagnose = new PatientDiagnose;
	        $patientDiagnose->diagnose_id = $request->diagnose;
	        $patientDiagnose->patient_record_id = $record->id;
	        $patientDiagnose->diagnoses = $request->diagnoses_description;
	        $patientDiagnose->remarks = $request->remarks;
	        $patientDiagnose->save();
		}

		$vitalSign = new VitalSign;
        $vitalSign->patient_record_id = $record->id;
        $vitalSign->date = $request->addmission_date;
        $vitalSign->time = $request->addmission_time;
        $vitalSign->bp = $request->blood_pressure;
        $vitalSign->t = $request->temperature;
        $vitalSign->p = $request->pulse_rate;
        $vitalSign->save();

        return 'success';
    }
}
