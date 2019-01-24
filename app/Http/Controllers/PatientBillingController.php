<?php

namespace App\Http\Controllers;

use App\PatientBilling;
use App\PatientRecord;
use App\TypeOfCharge;
use App\Type;
use Illuminate\Http\Request;

class PatientBillingController extends Controller
{
    public $page = 'Patient Billing';
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
        $patientBillings = PatientBilling::with([
            'records'
        ])->where('patient_record_id', $patientRecord->id)
            ->get();
        // return $patientBillings;
        return view('admin.patientBillings.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'patientBillings' => $patientBillings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PatientRecord $patientRecord)
    {
        $types = Type::with(['typeOfCharges'])->get();
        // return $types;
        return view('admin.patientBillings.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'types' => $types
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
        $typeOfCharge = typeOfCharge::where('id', $request->typeOfCharge)->get();
        $patientBilling = new PatientBilling;
        $patientBilling->patient_record_id = $patientRecord->id;
        // $patientBilling->type_of_charge_id = $request->typeOfCharge;
        $patientBilling->code = $request->code;
        $patientBilling->quantity = $request->quantity;
        $patientBilling->price =  $request->price;
        $patientBilling->total = ($request->quantity * $request->price);
        $patientBilling->description = $request->description;
        $patientBilling->save();
        return redirect()->route('patientBillings.index', $patientRecord);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function show(PatientBilling $patientBilling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientRecord $patientRecord, PatientBilling $patientBilling)
    {
        $types = Type::with(['typeOfCharges'])->get();
        // return $types;
        return view('admin.patientBillings.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'types' => $types,
            'patientBilling' => $patientBilling
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientRecord $patientRecord, PatientBilling $patientBilling)
    {
        $typeOfCharge = typeOfCharge::where('id', $request->typeOfCharge)->get();
        $patientBilling->patient_record_id = $patientRecord->id;
        // $patientBilling->type_of_charge_id = $request->typeOfCharge;
        $patientBilling->code = $request->code;
        $patientBilling->quantity = $request->quantity;
        $patientBilling->price =  $request->price;
        $patientBilling->total = ($request->quantity * $request->price);
        $patientBilling->description = $request->description;
        $patientBilling->save();
        return redirect()->route('patientBillings.index', $patientRecord);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PatientBilling  $patientBilling
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientRecord $patientRecord, PatientBilling $patientBilling)
    {
        $patientBilling->delete();
        return redirect()->route('patientBillings.index', $patientRecord);
    }

    public function print(PatientRecord $patientRecord)
    {
        $patientBillings = PatientBilling::where('patient_record_id', $patientRecord->id)->get();
        return view('admin.patientBillings.print', [
            'patientRecord' => $patientRecord,
            'patientBillings' => $patientBillings
        ]);
    }
}
