<?php

namespace App\Http\Controllers;

use App\MedicationAndTreatment;
use App\PatientRecord;
use Illuminate\Http\Request;

class MedicationAndTreatmentController extends Controller
{
    public $page = 'Medication And Treatment';
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
        $medicationAndTreatments = MedicationAndTreatment::all();
        return view('admin.medicationAndTreatments.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicationAndTreatments' => $medicationAndTreatments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patientRecords = PatientRecord::all();
        return view('admin.medicationAndTreatments.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecords' => $patientRecords,
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
        $medicationAndTreatment = new MedicationAndTreatment;
        $medicationAndTreatment->patient_record_id = $request->patientRecord;
        $medicationAndTreatment->medicine = $request->medicine;
        $medicationAndTreatment->date = $request->date;
        $medicationAndTreatment->time = $request->time;
        $medicationAndTreatment->remarks = $request->remarks;
        $medicationAndTreatment->save();
        return redirect()->route('medicationAndTreatments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicationAndTreatment  $medicationAndTreatment
     * @return \Illuminate\Http\Response
     */
    public function show(MedicationAndTreatment $medicationAndTreatment)
    {
        return view('admin.medicationAndTreatments.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicationAndTreatment' => $medicationAndTreatment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicationAndTreatment  $medicationAndTreatment
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicationAndTreatment $medicationAndTreatment)
    {
        $patientRecords = PatientRecord::all();
        return view('admin.medicationAndTreatments.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicationAndTreatment' => $medicationAndTreatment,
            'patientRecords' => $patientRecords,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicationAndTreatment  $medicationAndTreatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicationAndTreatment $medicationAndTreatment)
    {
        $medicationAndTreatment->patient_record_id = $request->patientRecord;
        $medicationAndTreatment->medicine = $request->medicine;
        $medicationAndTreatment->date = $request->date;
        $medicationAndTreatment->time = $request->time;
        $medicationAndTreatment->remarks = $request->remarks;
        $medicationAndTreatment->save();
        return redirect()->route('medicationAndTreatments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicationAndTreatment  $medicationAndTreatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicationAndTreatment $medicationAndTreatment)
    {
        $medicationAndTreatment->delete();
        return redirect()->route('medicationAndTreatments.index');
    }
}
