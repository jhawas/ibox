<?php

namespace App\Http\Controllers;

use App\PatientRecord;
use App\RecordType;
use App\Room;
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
        $patientRecords = PatientRecord::all();
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
        $recordTypes = RecordType::all();
        $rooms = Room::all();
        return view('admin.patientRecords.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'recordTypes' => $recordTypes,
            'rooms' => $rooms
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
        $patientRecord->code = $request->code;
        $patientRecord->description = $request->description;
        $patientRecord->save();
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
        return view('admin.patientRecords.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
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
        $patientRecord->code = $request->code;
        $patientRecord->description = $request->description;
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
