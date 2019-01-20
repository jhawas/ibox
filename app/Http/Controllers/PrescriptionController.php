<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\PatientRecord;
use App\MedicineStock;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public $page = 'Prescriptions';
    public $description = 'List of all ';

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
        $prescriptions = Prescription::all();
        return view('admin.prescriptions.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'prescriptions' => $prescriptions
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
        return view('admin.prescriptions.create', [
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
        $prescription = new Prescription;
        $prescription->patient_record_id = $request->patientRecord;
        $prescription->description = $request->description;
        $prescription->save();
        return redirect()->route('prescriptions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        return view('admin.prescriptions.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'prescription' => $prescription,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescription $prescription)
    {
        $patientRecords = PatientRecord::all();
        return view('admin.prescriptions.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'prescription' => $prescription,
            'patientRecords' => $patientRecords,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        $is_approved = $request->is_approved == 'on' ? true : false;
        $prescription->description = $request->description;
        $prescription->patient_record_id = $request->patientRecord;
        $prescription->is_approved = $is_approved;
        $prescription->save();
        return redirect()->route('prescriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index');
    }
}
