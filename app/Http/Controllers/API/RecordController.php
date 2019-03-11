<?php

namespace App\Http\Controllers\API;

use App\PatientRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $records = PatientRecord::with([
            'patient', 
            'recordType',
            'physician',
            'admit_checkup_by',
            'discharged_by',
            'room' => function($query) {
                $query->with([
                    'room_type'
                ]);
            },
        ])->get();
        return $records;
    }

    public function dataByRecordType($type_of_record_id = null)
    {
        $records = PatientRecord::with([
            'patient', 
            'recordType',
            'physician',
            'admit_checkup_by',
            'discharged_by',
            'room' => function($query) {
                $query->with([
                    'room_type'
                ]);
            },
        ])->where('type_of_record_id', $type_of_record_id)->get();
        return $records;
    }


    public function delete($id = null) {
    	$record = PatientRecord::where('id', $id)->first();
        $record->delete();
        return 'success';
    }

    public function edit($id) {
    	$record = PatientRecord::where('id', $id)->first();
        return $record;
    }

    public function update(Request $request, $id = null) {
    	$record = PatientRecord::where('id', $id)->first();
        $record->save();
        return 'success';
    }

    public function store(Request $request) {
    	$record = new PatientRecord;
        $record->save();
        return 'success';
    }
}
