<?php

namespace App\Http\Controllers;

use App\NursesNote;
use App\PatientRecord;
use Illuminate\Http\Request;

class NursesNoteController extends Controller
{
    public $page = 'Nurses Note';
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
        $nursesNotes = NursesNote::all();
        return view('admin.nursesNotes.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'nursesNotes' => $nursesNotes
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
        return view('admin.nursesNotes.create', [
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
        $nursesNote = new NursesNote;
        $nursesNote->patient_record_id = $request->patientRecord;
        $nursesNote->date = $request->date;
        $nursesNote->time = $request->time;
        $nursesNote->focus = $request->focus;
        $nursesNote->data_action_response = $request->data_action_response;
        $nursesNote->nurse_id = \Auth::user()->id;
        $nursesNote->save();
        return redirect()->route('nursesNotes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NursesNote  $nursesNote
     * @return \Illuminate\Http\Response
     */
    public function show(NursesNote $nursesNote)
    {
        return view('admin.nursesNotes.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'nursesNote' => $nursesNote,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NursesNote  $nursesNote
     * @return \Illuminate\Http\Response
     */
    public function edit(NursesNote $nursesNote)
    {
        $patientRecords = PatientRecord::all();
        return view('admin.nursesNotes.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'nursesNote' => $nursesNote,
            'patientRecords' => $patientRecords,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NursesNote  $nursesNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NursesNote $nursesNote)
    {
        $nursesNote->patient_record_id = $request->patientRecord;
        $nursesNote->date = $request->date;
        $nursesNote->time = $request->time;
        $nursesNote->focus = $request->focus;
        $nursesNote->data_action_response = $request->data_action_response;
        $nursesNote->nurse_id = \Auth::user()->id;
        $nursesNote->save();
        return redirect()->route('nursesNotes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NursesNote  $nursesNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(NursesNote $nursesNote)
    {
        $nursesNote->delete();
        return redirect()->route('nursesNotes.index');
    }
}
