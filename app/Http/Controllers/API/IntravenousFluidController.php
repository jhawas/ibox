<?php

namespace App\Http\Controllers\API;

use App\IntravenousFluid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntravenousFluidController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $intravenousFluids = IntravenousFluid::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	}
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return $intravenousFluids;
    }

    public function delete($id = null) {
    	$intravenousFluid = IntravenousFluid::where('id', $id)->first();
        $intravenousFluid->delete();
        return 'success';
    }

    public function edit($id) {
    	$intravenousFluid = IntravenousFluid::where('id', $id)->first();
        return $intravenousFluid;
    }

    public function update(Request $request, $id = null) {
    	$intravenousFluid = IntravenousFluid::where('id', $id)->first();
    	$intravenousFluid->patient_record_id = $request->patient_record_id;
        $intravenousFluid->date = $request->date;
        $intravenousFluid->time = $request->time;
        $intravenousFluid->bot_no = $request->bot_no;
        $intravenousFluid->kind_of_solution = $request->kind_of_solution;
        $intravenousFluid->vol = $request->vol;
        $intravenousFluid->gtss = $request->gtss;
        $intravenousFluid->remarks = $request->remarks;
        // $intravenousFluid->nurse_id = \Auth::user()->id;
        $intravenousFluid->save();
        return 'success';
    }

    public function store(Request $request) {
    	$intravenousFluid = new IntravenousFluid;
        $intravenousFluid->patient_record_id = $request->patient_record_id;
        $intravenousFluid->date = $request->date;
        $intravenousFluid->time = $request->time;
        $intravenousFluid->bot_no = $request->bot_no;
        $intravenousFluid->kind_of_solution = $request->kind_of_solution;
        $intravenousFluid->vol = $request->vol;
        $intravenousFluid->gtss = $request->gtss;
        $intravenousFluid->remarks = $request->remarks;
        // $intravenousFluid->nurse_id = \Auth::user()->id;
        $intravenousFluid->save();
        return 'success';
    }
}
