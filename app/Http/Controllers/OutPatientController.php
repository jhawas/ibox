<?php

namespace App\Http\Controllers;

use App\PatientRecord;
use App\Diagnose;
use App\Patient;
use App\User;
use App\Disposition;
use App\PhilhealthMembership;
use App\Result;
use App\PatientDiagnose;
use App\VitalSign;
use Illuminate\Http\Request;

class OutPatientController extends Controller
{
    public $page = 'Out Patient';
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
        $outPatients = PatientRecord::with([
            'patient', 
            'recordType',
            'room' => function($query) {
                $query->with([
                    'room_type'
                ]);
            },
        ])->where('type_of_record_id', 1)->get();
        // return $outPatients;
        return view('admin.outPatients.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'outPatients' => $outPatients
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
        $users = User::with([
            'user_role' => function($query) {
                $query->with(['role']);
            }
        ])->get();
        $dispositions = Disposition::all(); 
        $philhealthMemberships = PhilhealthMembership::all();
        $results = Result::all();
        // return $users;
        return view('admin.outPatients.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
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
        $patientRecord = new PatientRecord;
        $patientRecord->patient_id = $request->patient;
        $patientRecord->type_of_record_id = 1;
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
        $patientRecord->philhealth_membership_id = $this->isDropdownEmpty($request->philhealthMembership);
        $patientRecord->sponsor = $request->sponsor;
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

        return redirect()->route('outPatients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function show(PatientRecord $outPatient)
    {
        return view('admin.outPatients.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'outPatient' => $outPatient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRecord $outPatient)
    {
        $diagnoses = Diagnose::all();
        $patients = Patient::all();
        $patientDiagnose = PatientDiagnose::where('patient_record_id', $outPatient->id)->first();
        $users = User::all();
        $dispositions = Disposition::all(); 
        $philhealthMemberships = PhilhealthMembership::all();
        $results = Result::all();
        return view('admin.outPatients.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'outPatient' => $outPatient,
            'patients' => $patients,
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
    public function update(Request $request, PatientRecord $outPatient)
    {
        $patientDiagnose = PatientDiagnose::where('patient_record_id', $outPatient->id)->first();
        $patientDiagnose->diagnose_id = $this->isDropdownEmpty($request->diagnose);
        $patientDiagnose->patient_record_id = $outPatient->id;
        $patientDiagnose->diagnoses = $request->diagnoses_description;
        $patientDiagnose->remarks = $request->remarks;
        $patientDiagnose->save();

        $vitalSign = VitalSign::where('patient_record_id', $inPatient->id)->first();
        $vitalSign->patient_record_id = $patientRecord->id;
        $vitalSign->date = $request->admitted_checkup_date;
        $vitalSign->time = $request->admitted_checkup_time;
        $vitalSign->bp = $request->blood_pressure;
        $vitalSign->t = $request->temperature;
        $vitalSign->p = $request->pulse_rate;
        $vitalSign->r = $request->pulse_rate;
        $vitalSign->save();

        // patient record
        $outPatient->patient_id = $request->patient;
        $outPatient->type_of_record_id = 1;
        $outPatient->weight = $request->weight;
        $outPatient->height = $request->height;
        $outPatient->temperature = $request->temperature;
        $outPatient->blood_pressure = $request->blood_pressure;
        $outPatient->pulse_rate = $request->pulse_rate;
        $outPatient->admitted_and_check_up_by = $this->isDropdownEmpty($request->admitted_checkup_by);
        $outPatient->addmitted_and_check_up_date = $request->admitted_checkup_date;
        $outPatient->addmitted_and_check_up_time = $request->admitted_checkup_time;
        $outPatient->attending_physician = $this->isDropdownEmpty($request->physician);
        $outPatient->chart_completed_by = $this->isDropdownEmpty($request->chartCompletedBy);
        $outPatient->philhealth_membership_id = $this->isDropdownEmpty($request->philhealthMembership);
        $outPatient->sponsor = $request->sponsor;
        $outPatient->save();
        return redirect()->route('outPatients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientRecord  $patientRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecord $outPatient)
    {
        $outPatient->delete();
        return redirect()->route('outPatients.index');
    }

    public function isDropdownEmpty($value) {
        return $value == 0 ? null : $value;
    }
}
