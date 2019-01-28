<?php

namespace App\Http\Controllers;

use App\PatientRecord;
use App\TypeOfCharge;
use App\PatientDiagnose;
use App\Diagnose;
use App\Room;
use App\User;
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
        $patientInformations = Patient::all();
        $recordTypes = TypeOfRecord::all();
        $rooms = Room::all();
        return view('admin.patientRecords.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'recordTypes' => $recordTypes,
            'rooms' => $rooms,
            'patientInformations' => $patientInformations,
            'diagnoses' => $diagnoses,
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
        $patientRecord->patient_id = $request->patientInformation;
        $patientRecord->type_of_charge_id = $request->recordType;
        $patientRecord->room_id = $request->room;
        // $patientRecord->started_at = $request->startAt;
        // $patientRecord->end_at = $request->endAt;
        $patientRecord->description = $request->description;
        $patientRecord->discharged = $discharged;
        $patientRecord->save();

        // initial diagnoses
        $patientDiagnose = new PatientDiagnose;
        $patientDiagnose->diagnose_id = $request->diagnoses;
        $patientDiagnose->patient_record_id = $patientRecord->id;
        $patientDiagnose->weight = $request->weight;
        $patientDiagnose->height = $request->height;
        $patientDiagnose->temperature = $request->temperature;
        $patientDiagnose->blood_pressure = $request->blood_pressure;
        $patientDiagnose->pulse_rate = $request->pulse_rate;
        $patientDiagnose->description = $request->diagnoses_description;
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
        $patientInformations = Patient::all();
        $recordTypes = TypeOfRecord::all();
        $patientDiagnose = PatientDiagnose::where('patient_record_id', $patientRecord->id)->first();
        $rooms = Room::all();
        return view('admin.patientRecords.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'patientInformations' => $patientInformations,
            'recordTypes' => $recordTypes,
            'rooms' => $rooms,
            'diagnoses' => $diagnoses,
            'patientDiagnose' => $patientDiagnose,
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
        $patientDiagnose->diagnose_id = $request->diagnoses;
        $patientDiagnose->patient_record_id = $patientRecord->id;
        $patientDiagnose->weight = $request->weight;
        $patientDiagnose->height = $request->height;
        $patientDiagnose->temperature = $request->temperature;
        $patientDiagnose->blood_pressure = $request->blood_pressure;
        $patientDiagnose->pulse_rate = $request->pulse_rate;
        $patientDiagnose->description = $request->diagnoses_description;
        $patientDiagnose->save();

        $discharged = $request->discharged == 'on' ? true : false;
        $patientRecord->patient_id = $request->patientInformation;
        $patientRecord->type_of_charge_id = $request->recordType;
        $patientRecord->room_id = $request->room;
        // $patientRecord->started_at = $request->startAt;
        // $patientRecord->end_at = $request->endAt;
        $patientRecord->description = $request->description;
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
}
