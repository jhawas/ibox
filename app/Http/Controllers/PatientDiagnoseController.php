<?php

namespace App\Http\Controllers;

use App\PatientDiagnose;
use App\Diagnose;
use App\PatientRecord;
use Illuminate\Http\Request;

class PatientDiagnoseController extends Controller
{
    public $page = 'Patient Diagnoses';
    public $description = ' ';

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
    public function index(PatientRecord $patientRecord)
    {
        $patientDiagnoses = PatientDiagnose::with([
            'diagnose',
            'record' => function($record) {
                $record->with([
                    'user',
                    'room'
                ]);
            }
        ])->where('patient_record_id', $patientRecord->id)->get();
        // return $patientDiagnoses;
        return view('admin.patientDiagnoses.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'patientDiagnoses' => $patientDiagnoses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PatientRecord $patientRecord)
    {
        $diagnoses = Diagnose::all();
        // return $types;
        return view('admin.patientDiagnoses.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'diagnoses' => $diagnoses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PatientRecord $patientRecord)
    {
        $patientDiagnose = new PatientDiagnose;
        $patientDiagnose->patient_record_id = $patientRecord->id;
        $patientDiagnose->diagnose_id = $request->diagnoses;
        $patientDiagnose->description = $request->description;
        $patientDiagnose->save();
        return redirect()->route('patientDiagnoses.index', $patientRecord);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientDiagnoses  $patientDiagnoses
     * @return \Illuminate\Http\Response
     */
    public function show(PatientDiagnose $patientDiagnose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientDiagnoses  $patientDiagnoses
     * @return \Illuminate\Http\Response
     */
    public function edit( PatientRecord $patientRecord, PatientDiagnose $patientDiagnose)
    {
        $diagnoses = Diagnose::all();
        return view('admin.patientDiagnoses.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'diagnoses' => $diagnoses,
            'patientDiagnose' => $patientDiagnose
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientDiagnoses  $patientDiagnoses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientRecord $patientRecord, PatientDiagnose $patientDiagnose)
    {
        $patientDiagnose->patient_record_id = $patientRecord->id;
        $patientDiagnose->diagnose_id = $request->diagnoses;
        $patientDiagnose->description = $request->description;
        $patientDiagnose->save();
        return redirect()->route('patientDiagnoses.index', $patientRecord);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientDiagnoses  $patientDiagnoses
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecord $patientRecord, PatientDiagnose $patientDiagnose)
    {
        $patientDiagnose->delete();
        return redirect()->route('patientDiagnoses.index', $patientRecord);
    }
}
