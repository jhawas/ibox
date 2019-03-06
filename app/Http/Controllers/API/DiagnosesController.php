<?php

namespace App\Http\Controllers\API;

use App\Diagnose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiagnosesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $diagnoses = Diagnose::all();
        return $diagnoses;
    }

    public function delete($id = null) {
    	$diagnose = Diagnose::where('id', $id)->first();
        $diagnose->delete();
        return 'success';
    }

    public function edit($id) {
    	$diagnose = Diagnose::where('id', $id)->first();
        return $diagnose;
    }

    public function update(Request $request, $id = null) {
    	$diagnose = Diagnose::where('id', $id)->first();
        $diagnose->save();
        return 'success';
    }

    public function store(Request $request) {
    	$diagnose = new Diagnose;
        $diagnose->save();
        return 'success';
    }
}
