<?php

namespace App\Http\Controllers;

use App\PatientRecord;
use App\RecordType;
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
            'user', 
            'recordType'
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
        $patientInformations = User::where('is_user', 0)->get();
        $recordTypes = RecordType::all();
        $rooms = Room::all();
        return view('admin.patientRecords.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'recordTypes' => $recordTypes,
            'rooms' => $rooms,
            'patientInformations' => $patientInformations
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
        $isReleased = $request->isReleased == 'on' ? true : false;
        $patientRecord = new PatientRecord;
        $patientRecord->user_id = $request->patientInformation;
        $patientRecord->record_type_id = $request->recordType;
        $patientRecord->room_id = $request->room;
        $patientRecord->started_at = $request->startAt;
        $patientRecord->end_at = $request->endAt;
        $patientRecord->description = $request->description;
        $patientRecord->isReleased = $isReleased;
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
        $patientInformations = User::where('is_user', 0)->get();
        $recordTypes = RecordType::all();
        $rooms = Room::all();
        return view('admin.patientRecords.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            'patientInformations' => $patientInformations,
            'recordTypes' => $recordTypes,
            'rooms' => $rooms
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
        $isReleased = $request->isReleased == 'on' ? true : false;
        $patientRecord->user_id = $request->patientInformation;
        $patientRecord->record_type_id = $request->recordType;
        $patientRecord->room_id = $request->room;
        $patientRecord->started_at = $request->startAt;
        $patientRecord->end_at = $request->endAt;
        $patientRecord->description = $request->description;
        $patientRecord->isReleased = $isReleased;
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
