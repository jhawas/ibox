<?php

namespace App\Http\Controllers;

use App\PatientBilling;
use App\PatientRecord;
use Illuminate\Http\Request;

class PrintController extends Controller
{
	public $record_id;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function printBilling($patient_record_id = null)
    {
    	$this->record_id = $patient_record_id;
    	$typeOfCharges = \App\TypeOfCharge::with([
    		'billings' => function($query) {
                $query->where('patient_record_id', $this->record_id);
            },
    		'child' => function($query) {
                $query->with([
                    'billings' => function($query) {
                        $query->where('patient_record_id', $this->record_id);
                    }
                ]);
            },
    	])->where('parent_id', null)->get();
    	// return $typeOfCharges;
        $patientRecord = PatientRecord::where('id', $patient_record_id)->first();
    	return view('admin.print.billing', [
            'patientRecord' => $patientRecord,
            'typeOfCharges' => $typeOfCharges
        ]);
    }
}
