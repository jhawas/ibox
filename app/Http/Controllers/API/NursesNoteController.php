<?php

namespace App\Http\Controllers\API;

use App\NursesNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NursesNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $nursesNotes = NursesNote::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	}
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return $nursesNotes;
    }

    public function delete($id = null) {
    	$nursesNote = NursesNote::where('id', $id)->first();
        $nursesNote->delete();
        return 'success';
    }

    public function edit($id) {
    	$nursesNote = NursesNote::where('id', $id)->first();
        return $nursesNote;
    }

    public function update(Request $request, $id = null) {
    	$nursesNote = NursesNote::where('id', $id)->first();
    	$nursesNote->patient_record_id = $request->patient_record_id;
        $nursesNote->date = $request->date;
        $nursesNote->time = $request->time;
        $nursesNote->focus = $request->focus;
        $nursesNote->data_action_response = $request->data_action_response;
        $nursesNote->nurse_id = $request->user_id;
        $nursesNote->save();
        return 'success';
    }

    public function store(Request $request) {
    	$nursesNote = new NursesNote;
        $nursesNote->patient_record_id = $request->patient_record_id;
        $nursesNote->date = $request->date;
        $nursesNote->time = $request->time;
        $nursesNote->focus = $request->focus;
        $nursesNote->data_action_response = $request->data_action_response;
        $nursesNote->nurse_id = $request->user_id;
        $nursesNote->save();
        return 'success';
    }
}
