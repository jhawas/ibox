<?php

namespace App\Http\Controllers\API;

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
        	},
        	'laboratory'
        ])->where('patient_record_id', $patient_record_id)
        	->get();
        return response()->json($laboratoryTests);
    }

    public function delete($id = null) {
    	$laboratoryTest = LaboratoryTest::where('id', $id)->first();
        Storage::delete(['public/laboratory/'.$laboratoryTest->image]);
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
        if ($request->get('file')) {
            // delete old logo
            Storage::delete(['public/laboratory/'.$laboratoryTest->image]);
            $image = $request->get('file');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
              \Image::make($request->get('file'))->save(public_path('storage/laboratory/').$name);
            $laboratoryTest->image = $name;
        }
    	$laboratoryTest->patient_record_id = $request->patient_record_id;
        $laboratoryTest->type_of_laboratory_id = $request->type_of_laboratory_id;
        $laboratoryTest->description = $request->description;
        $laboratoryTest->save();
        return 'success';
    }

    public function store(Request $request) {

        if($request->get('file')) {
          $image = $request->get('file');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('file'))->save(public_path('storage/laboratory/').$name);
        }

        $laboratoryTest = new LaboratoryTest;
        $laboratoryTest->patient_record_id = $request->patient_record_id;
        $laboratoryTest->type_of_laboratory_id = $request->type_of_laboratory_id;
        $laboratoryTest->description = $request->description;
        $laboratoryTest->image = $name;
        $laboratoryTest->save();
        return 'success';
    }

}
