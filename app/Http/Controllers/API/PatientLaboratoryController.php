<?php

namespace App\Http\Controllers\API;

use App\DoctorsOrder;
use App\LaboratoryTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;

class PatientLaboratoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $laboratoryTests = LaboratoryTest::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	}
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return response()->json($laboratoryTests);
    }

    public function delete($id = null) {
    	$laboratoryTest = LaboratoryTest::where('id', $id)->first();
        $files = json_decode($laboratoryTest->image);
        Storage::deleteDirectory('public/laboratory/'.$laboratoryTest->patient_record_id);
        // for($i=0; $i < count($files); $i++) {
        //     Storage::delete(['public/laboratory/'.$files[$i]]);
        // }
        $laboratoryTest->delete();
        return 'success';
    }

    public function edit($id) {
    	$laboratoryTest = LaboratoryTest::with([
        	'record' => function($query) {
        		$query->with(['patient']);
        	},
        	'laboratory'
        ])->where('id', $id)->first();
        return $laboratoryTest;
    }

    public function update(Request $request, $id = null) {
    	$laboratoryTest = LaboratoryTest::where('id', $id)->first();
        if($request->hasfile('files')) {
            $files = json_decode($laboratoryTest->image);
            Storage::deleteDirectory('public/laboratory/'.$laboratoryTest->patient_record_id);
            // for($i=0; $i < count($files); $i++) {
            //     Storage::delete(['public/laboratory/'.$files[$i]]);
            // }
            foreach($request->file('files') as $key => $file) {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/storage/laboratory/'. $request->patient_record_id, $name);  
                $data[$key] = $name;  
            }
            $laboratoryTest->image = json_encode($data);
        }
    	$laboratoryTest->patient_record_id = $request->patient_record_id;
        $laboratoryTest->type_of_laboratory_id = $request->type_of_laboratory_id;
        $laboratoryTest->description = $request->description;
        $laboratoryTest->save();
        return 'success';
    }

    public function store(Request $request) {
        if($request->hasfile('files')) {
            foreach($request->file('files') as $key => $file) {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/storage/laboratory/'. $request->patient_record_id, $name);  
                $data[$key] = $name;  
            }
        }

        $doctorsOrder = DoctorsOrder::where('id', $request->doctor_order_id)->first();
        $doctorsOrder->approved = 1;
        $doctorsOrder->save();

        $laboratoryTest = new LaboratoryTest;
        $laboratoryTest->patient_record_id = $request->patient_record_id;
        $laboratoryTest->type_of_laboratory_id = $request->type_of_laboratory_id;
        $laboratoryTest->description = $request->description;
        $laboratoryTest->image = json_encode($data);
        $laboratoryTest->save();

        return 'success';
    }

}
