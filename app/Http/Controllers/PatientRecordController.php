<?php

namespace App\Http\Controllers;

use App\PatientRecord;
use App\TypeOfRecord;
use App\PatientDiagnose;
use App\Diagnose;
use App\Room;
use App\Patient;
use App\User;
use App\Disposition;
use App\Result;
use App\PhilhealthMembership;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    public $page = 'Patient Records';
    public $description = 'List of ';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientRecords = PatientRecord::with([
            'patient', 
            'recordType',
            'room' => function($query) {
                $query->with([
                    'room_type'
                ]);
            },
        ])->get();
        // return $patientRecords;
        return view('admin.patientRecords.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecords' => $patientRecords
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $diagnoses = Diagnose::all();
        $patients = Patient::all();
        $typeOfRecords = TypeOfRecord::all();
        $rooms = Room::all();
        $users = User::all();
        $dispositions = Disposition::all(); 
        $philhealthMemberships = PhilhealthMembership::all();
        $results = Result::all();
        return view('admin.patientRecords.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'typeOfRecords' => $typeOfRecords,
            'rooms' => $rooms,
            'patients' => $patients,
            'diagnoses' => $diagnoses,
            'users' => $users,
            'dispositions' => $dispositions,
            'philhealthMemberships' => $philhealthMemberships,
            'results' => $results,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $discharged = $request->discharged == 'on' ? true : false;
        $patientRecord = new PatientRecord;
        $patientRecord->patient_id = $request->patient;
        $patientRecord->type_of_record_id = $this->isDropdownEmpty($request->typeOfRecord);
        $patientRecord->room_id = $this->isDropdownEmpty($request->room);
        $patientRecord->bed = $request->bed;
        $patientRecord->weight = $request->weight;
        $patientRecord->height = $request->height;
        $patientRecord->temperature = $request->temperature;
        $patientRecord->blood_pressure = $request->blood_pressure;
        $patientRecord->pulse_rate = $request->pulse_rate;
        $patientRecord->admitted_and_check_up_by = $this->isDropdownEmpty($request->admitted_checkup_by);
        $patientRecord->addmitted_and_check_up_date = $request->admitted_checkup_date;
        $patientRecord->addmitted_and_check_up_time = $request->admitted_checkup_time;
        $patientRecord->discharge_by = $this->isDropdownEmpty($request->discharge_by);
        $patientRecord->discharge_date = $request->discharge_date;
        $patientRecord->discharge_time = $request->discharge_time;
        $patientRecord->attending_physician = $this->isDropdownEmpty($request->physician);
        $patientRecord->chart_completed_by = $this->isDropdownEmpty($request->chartCompletedBy);
        $patientRecord->disposition_id = $this->isDropdownEmpty($request->disposition);
        $patientRecord->philhealth_membership_id = $this->isDropdownEmpty($request->philhealthMembership);
        $patientRecord->result_id = $this->isDropdownEmpty($request->result);
        $patientRecord->sponsor = $request->sponsor;
        $patientRecord->discharged = $discharged;
        $patientRecord->save();

        // initial diagnoses
        $patientDiagnose = new PatientDiagnose;
        $patientDiagnose->diagnose_id = $this->isDropdownEmpty($request->diagnose);
        $patientDiagnose->patient_record_id = $patientRecord->id;
        $patientDiagnose->diagnoses = $request->diagnoses_description;
        $patientDiagnose->remarks = $request->remarks;
        $patientDiagnose->save();

        return redirect()->route('patientRecords.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function show(PatientRecord $patientRecord)
    {
        return view('admin.patientRecords.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRecord $patientRecord)
    {
        $diagnoses = Diagnose::all();
        $patients = Patient::all();
        $typeOfRecords = TypeOfRecord::all();
        $patientDiagnose = PatientDiagnose::where('patient_record_id', $patientRecord->id)->first();
        $rooms = Room::all();
        $users = User::all();
        $dispositions = Disposition::all(); 
        $philhealthMemberships = PhilhealthMembership::all();
        $results = Result::all();
        return view('admin.patientRecords.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'patients' => $patients,
            'typeOfRecords' => $typeOfRecords,
            'rooms' => $rooms,
            'diagnoses' => $diagnoses,
            'patientDiagnose' => $patientDiagnose,
            'users' => $users,
            'dispositions' => $dispositions,
            'philhealthMemberships' => $philhealthMemberships,
            'results' => $results,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientRecord $patientRecord)
    {
        $patientDiagnose = PatientDiagnose::where('patient_record_id', $patientRecord->id)->first();
        $patientDiagnose->diagnose_id = $this->isDropdownEmpty($request->diagnose);
        $patientDiagnose->patient_record_id = $patientRecord->id;
        $patientDiagnose->diagnoses = $request->diagnoses_description;
        $patientDiagnose->remarks = $request->remarks;
        $patientDiagnose->save();

        // patient record
        $discharged = $request->discharged == 'on' ? true : false;
        $patientRecord->patient_id = $request->patient;
        $patientRecord->type_of_record_id = $this->isDropdownEmpty($request->typeOfRecord);
        $patientRecord->room_id = $this->isDropdownEmpty($request->room);
        $patientRecord->bed = $request->bed;
        $patientRecord->weight = $request->weight;
        $patientRecord->height = $request->height;
        $patientRecord->temperature = $request->temperature;
        $patientRecord->blood_pressure = $request->blood_pressure;
        $patientRecord->pulse_rate = $request->pulse_rate;
        $patientRecord->admitted_and_check_up_by = $this->isDropdownEmpty($request->admitted_checkup_by);
        $patientRecord->addmitted_and_check_up_date = $request->admitted_checkup_date;
        $patientRecord->addmitted_and_check_up_time = $request->admitted_checkup_time;
        $patientRecord->discharge_by = $this->isDropdownEmpty($request->discharge_by);
        $patientRecord->discharge_date = $request->discharge_date;
        $patientRecord->discharge_time = $request->discharge_time;
        $patientRecord->attending_physician = $this->isDropdownEmpty($request->physician);
        $patientRecord->chart_completed_by = $this->isDropdownEmpty($request->chartCompletedBy);
        $patientRecord->disposition_id = $this->isDropdownEmpty($request->disposition);
        $patientRecord->philhealth_membership_id = $this->isDropdownEmpty($request->philhealthMembership);
        $patientRecord->result_id = $this->isDropdownEmpty($request->result);
        $patientRecord->sponsor = $request->sponsor;
        $patientRecord->discharged = $discharged;
        $patientRecord->save();
        return redirect()->route('patientRecords.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecord $patientRecord)
    {
        $patientRecord->delete();
        return redirect()->route('patientRecords.index');
    }

    public function isDropdownEmpty($value) {
        return $value == 0 ? null : $value;
    }
}
