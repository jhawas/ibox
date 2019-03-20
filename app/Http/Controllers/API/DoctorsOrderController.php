<?php

namespace App\Http\Controllers\API;

use App\DoctorsOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorsOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $doctorsOrders = DoctorsOrder::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	},
            'user'
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return $doctorsOrders;
    }

    public function delete($id = null) {
    	$doctorsOrder = DoctorsOrder::where('id', $id)->first();
        $doctorsOrder->delete();
        return 'success';
    }

    public function edit($id) {
    	$doctorsOrder = DoctorsOrder::where('id', $id)->first();
        $doctorsOrder->laboratories = explode(',',$doctorsOrder->laboratories);
        return $doctorsOrder;
    }

    public function update(Request $request, $id = null) {
    	$doctorsOrder = DoctorsOrder::where('id', $id)->first();
    	$doctorsOrder->patient_record_id = $request->patient_record_id;
        $doctorsOrder->date = $request->date;
        $doctorsOrder->time = $request->time;
        $doctorsOrder->progress_note = $request->progress_note;
        $doctorsOrder->doctors_orders = $request->doctors_orders;
        $doctorsOrder->physician_id = $request->user_id;
        $doctorsOrder->laboratories = implode(',', $request->laboratories);
        $doctorsOrder->save();
        return 'success';
    }

    public function store(Request $request) {
    	$doctorsOrder = new DoctorsOrder;
        $doctorsOrder->patient_record_id = $request->patient_record_id;
        $doctorsOrder->date = $request->date;
        $doctorsOrder->time = $request->time;
        $doctorsOrder->progress_note = $request->progress_note;
        $doctorsOrder->doctors_orders = $request->doctors_orders;
        $doctorsOrder->physician_id = $request->user_id;
        $doctorsOrder->laboratories = implode(',', $request->laboratories);
        $doctorsOrder->save();
        return 'success';
    }
}
