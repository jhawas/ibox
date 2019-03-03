<?php

namespace App\Http\Controllers;

use App\LaboratoryTest;
use App\PatientRecord;
use App\TypeOfLaboratory;
use Illuminate\Http\Request;
use Illuminate\Http\File;

use Storage;

class LaboratoryTestController extends Controller
{
    public $page = 'Laboratory Test';
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
        $laboratoryTests = LaboratoryTest::with([
            'record' => function($record) {
                $record->with([
                    'patient'
                ]);
            },
            'laboratory'
        ])->get();
        // return $laboratoryTests;
        return view('admin.laboratoryTests.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'laboratoryTests' => $laboratoryTests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patientRecords = PatientRecord::with([
            'patient'
        ])->where('discharged', 0)->get();
        // return $patientRecords;
        $typeOfTests = TypeOfLaboratory::all();
        return view('admin.laboratoryTests.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecords' => $patientRecords,
            'typeOfTests' => $typeOfTests,
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
        $file_path = null;
        if ($request->hasFile('file')) {
            $file_path = Storage::putFile('public/laboratory', $request->file('file'));
        }  
        $laboratoryTest = new LaboratoryTest;
        $laboratoryTest->patient_record_id = $request->patientRecord;
        $laboratoryTest->type_of_laboratory_id = $request->typeOfTest;
        $laboratoryTest->description = $request->description;
        $laboratoryTest->image = $file_path;
        $laboratoryTest->save();
        return redirect()->route('laboratoryTests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LaboratoryTest  $laboratoryTest
     * @return \Illuminate\Http\Response
     */
    public function show(LaboratoryTest $laboratoryTest)
    {
        return view('admin.laboratoryTests.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'laboratoryTest' => $laboratoryTest,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LaboratoryTest  $laboratoryTest
     * @return \Illuminate\Http\Response
     */
    public function edit(LaboratoryTest $laboratoryTest)
    {
        $patientRecords = PatientRecord::with([
            'patient'
        ])->where('discharged', 0)->get();
        $typeOfTests = TypeOfLaboratory::all();
        return view('admin.laboratoryTests.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'laboratoryTest' => $laboratoryTest,
            'patientRecords' => $patientRecords,
            'typeOfTests' => $typeOfTests
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LaboratoryTest  $laboratoryTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaboratoryTest $laboratoryTest)
    {

        // path of image uploaded
        if ($request->hasFile('file')) {
            // delete old logo
            Storage::delete([$laboratoryTest->image]);
            // upload videos and assigned
            $file_path = Storage::putFile('public/laboratory', $request->file('file'));
            $laboratoryTest->image = $file_path;
        }
        $laboratoryTest->patient_record_id = $request->patientRecord;
        $laboratoryTest->type_of_laboratory_id = $request->typeOfTest;
        $laboratoryTest->description = $request->description;
        $laboratoryTest->save();
        return redirect()->route('laboratoryTests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LaboratoryTest  $laboratoryTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaboratoryTest $laboratoryTest)
    {
        Storage::delete([$laboratoryTest->image]);
        $laboratoryTest->delete();
        return redirect()->route('laboratoryTests.index');
    }
}
