<?php

namespace App\Http\Controllers\API;

use App\VitalSign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VitalSignController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function vitalSigns($patient_record_id = null)
    {
        $vitalSigns = VitalSign::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	}
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return $vitalSigns;
    }

    public function delete($id = null) {
    	$vitalSign = VitalSign::where('id', $id)->first();
        $vitalSign->delete();
        return 'success';
    }

    public function edit($id) {
    	$vitalSign = VitalSign::where('id', $id)->first();
        return $vitalSign;
    }

    public function update(Request $request, $id = null) {
    	$vitalSign = VitalSign::where('id', $id)->first();
    	$vitalSign->patient_record_id = $request->patient_record_id;
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
        return 'success';
    }

    public function store(Request $request) {
    	$vitalSign = new VitalSign;
        $vitalSign->patient_record_id = $request->patient_record_id;
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
        return 'success';
    }
}
