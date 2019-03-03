<?php

namespace App\Http\Controllers;

use App\VitalSign;
use App\PatientRecord;
use Illuminate\Http\Request;

class VitalSignController extends Controller
{
    public $page = 'Vital Signs';
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
        $vitalSigns = VitalSign::all();
        return view('admin.vitalSigns.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'vitalSigns' => $vitalSigns
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patientRecords = PatientRecord::with([
            'patient'
        ])->where('discharged', 0)->get();
        return view('admin.vitalSigns.create', [
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
        $vitalSign = new VitalSign;
        $vitalSign->patient_record_id = $request->patientRecord;
        $vitalSign->date = $request->date;
        $vitalSign->time = $request->time;
        $vitalSign->bp = $request->bp;
        $vitalSign->t = $request->t;
        $vitalSign->p = $request->p;
        $vitalSign->r = $request->r;
        $vitalSign->intake_oral = $request->intake_oral;
        $vitalSign->intake_iv = $request->intake_iv;
        $vitalSign->intake_ng = $request->intake_ng;
        $vitalSign->total_intake = ($request->intake_oral + $request->intake_iv + $request->intake_ng);
        $vitalSign->output_urine = $request->output_urine;
        $vitalSign->output_stool = $request->output_stool;
        $vitalSign->output_emesis = $request->output_emesis;
        $vitalSign->output_ng = $request->output_ng;
        $vitalSign->total_output = ($request->output_urine + $request->output_stool + $request->output_emesis + $request->output_ng);
        $vitalSign->save();
        return redirect()->route('vitalSigns.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function show(VitalSign $vitalSign)
    {
        return view('admin.vitalSigns.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'vitalSign' => $vitalSign,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function edit(VitalSign $vitalSign)
    {
        $patientRecords = PatientRecord::with([
            'patient'
        ])->where('discharged', 0)->get();
        return view('admin.vitalSigns.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'vitalSign' => $vitalSign,
            'patientRecords' => $patientRecords,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VitalSign $vitalSign)
    {
        $vitalSign->patient_record_id = $request->patientRecord;
        $vitalSign->date = $request->date;
        $vitalSign->time = $request->time;
        $vitalSign->bp = $request->bp;
        $vitalSign->t = $request->t;
        $vitalSign->p = $request->p;
        $vitalSign->r = $request->r;
        $vitalSign->intake_oral = $request->intake_oral;
        $vitalSign->intake_iv = $request->intake_iv;
        $vitalSign->intake_ng = $request->intake_ng;
        $vitalSign->total_intake = ($request->intake_oral + $request->intake_iv + $request->intake_ng);
        $vitalSign->output_urine = $request->output_urine;
        $vitalSign->output_stool = $request->output_stool;
        $vitalSign->output_emesis = $request->output_emesis;
        $vitalSign->output_ng = $request->output_ng;
        $vitalSign->total_output = ($request->output_urine + $request->output_stool + $request->output_emesis + $request->output_ng);
        $vitalSign->save();
        return redirect()->route('vitalSigns.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function destroy(VitalSign $vitalSign)
    {
        $vitalSign->delete();
        return redirect()->route('vitalSigns.index');
    }
}
