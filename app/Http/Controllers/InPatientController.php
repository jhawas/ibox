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
use App\VitalSign;
use Illuminate\Http\Request;

class InPatientController extends Controller
{
    public $page = 'In Patient';
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
        $inPatients = PatientRecord::with([
            'patient', 
            'recordType',
            'room' => function($query) {
                $query->with([
                    'room_type'
                ]);
            },
        ])->where('type_of_record_id', 2)->where('discharged', 0)->get();
        // return $inPatients;
        return view('admin.inPatients.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'inPatients' => $inPatients
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
        $rooms = Room::all();
        $users = User::all();
        $dispositions = Disposition::all(); 
        $philhealthMemberships = PhilhealthMembership::all();
        $results = Result::all();
        return view('admin.inPatients.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
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
        $discharged = $request->discharged == 'on' ? true : false;
        $patientRecord = new PatientRecord;
        $patientRecord->patient_id = $request->patient;
        $patientRecord->type_of_record_id = 2;
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

        $vitalSign = new VitalSign;
        $vitalSign->patient_record_id = $patientRecord->id;
        $vitalSign->date = $request->admitted_checkup_date;
        $vitalSign->time = $request->admitted_checkup_time;
        $vitalSign->bp = $request->blood_pressure;
        $vitalSign->t = $request->temperature;
        $vitalSign->p = $request->pulse_rate;
        $vitalSign->r = $request->pulse_rate;
        $vitalSign->save();


        return redirect()->route('inPatients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function show(PatientRecord $inPatient)
    {
        return view('admin.inPatients.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'inPatient' => $inPatient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRecord $inPatient)
    {
        $diagnoses = Diagnose::all();
        $patients = Patient::all();
        $patientDiagnose = PatientDiagnose::where('patient_record_id', $inPatient->id)->first();
        $rooms = Room::all();
        $users = User::all();
        $dispositions = Disposition::all(); 
        $philhealthMemberships = PhilhealthMembership::all();
        $results = Result::all();
        return view('admin.inPatients.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'inPatient' => $inPatient,
            'patients' => $patients,
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
    public function update(Request $request, PatientRecord $inPatient)
    {
        $patientDiagnose = PatientDiagnose::where('patient_record_id', $inPatient->id)->first();
        $patientDiagnose->diagnose_id = $this->isDropdownEmpty($request->diagnose);
        $patientDiagnose->patient_record_id = $inPatient->id;
        $patientDiagnose->diagnoses = $request->diagnoses_description;
        $patientDiagnose->remarks = $request->remarks;
        $patientDiagnose->save();

        // $vitalSign = VitalSign::where('patient_record_id', $inPatient->id)->first();
        // // $vitalSign->patient_record_id = $inPatient->id;
        // $vitalSign->date = $request->admitted_checkup_date;
        // // $vitalSign->time = $request->admitted_checkup_time;
        // $vitalSign->bp = $request->blood_pressure;
        // $vitalSign->t = $request->temperature;
        // $vitalSign->p = $request->pulse_rate;
        // $vitalSign->r = $request->pulse_rate;
        // $vitalSign->save();

        // patient record
        $discharged = $request->discharged == 'on' ? true : false;
        $inPatient->patient_id = $request->patient;
        $inPatient->type_of_record_id = 2;
        $inPatient->room_id = $this->isDropdownEmpty($request->room);
        $inPatient->bed = $request->bed;
        $inPatient->weight = $request->weight;
        $inPatient->height = $request->height;
        $inPatient->temperature = $request->temperature;
        $inPatient->blood_pressure = $request->blood_pressure;
        $inPatient->pulse_rate = $request->pulse_rate;
        $inPatient->admitted_and_check_up_by = $this->isDropdownEmpty($request->admitted_checkup_by);
        $inPatient->addmitted_and_check_up_date = $request->admitted_checkup_date;
        $inPatient->addmitted_and_check_up_time = $request->admitted_checkup_time;
        $inPatient->discharge_by = $this->isDropdownEmpty($request->discharge_by);
        $inPatient->discharge_date = $request->discharge_date;
        $inPatient->discharge_time = $request->discharge_time;
        $inPatient->attending_physician = $this->isDropdownEmpty($request->physician);
        $inPatient->chart_completed_by = $this->isDropdownEmpty($request->chartCompletedBy);
        $inPatient->disposition_id = $this->isDropdownEmpty($request->disposition);
        $inPatient->philhealth_membership_id = $this->isDropdownEmpty($request->philhealthMembership);
        $inPatient->result_id = $this->isDropdownEmpty($request->result);
        $inPatient->sponsor = $request->sponsor;
        $inPatient->discharged = $discharged;
        $inPatient->save();
        return redirect()->route('inPatients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecord $inPatient)
    {
        $inPatient->delete();
        return redirect()->route('inPatients.index');
    }

    public function isDropdownEmpty($value) {
        return $value == 0 ? null : $value;
    }
}
