<?php

namespace App\Http\Controllers;

use App\LaboratoryTest;
use App\PatientRecord;
use App\TypeOfTest;
use Illuminate\Http\Request;

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
        $laboratoryTests = LaboratoryTest::all();
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
        $patientRecords = PatientRecord::all();
        $typeOfTests = TypeOfTest::all();
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
        $laboratoryTest = new LaboratoryTest;
        $laboratoryTest->code = $request->code;
        $laboratoryTest->description = $request->description;
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
        $patientRecords = PatientRecord::all();
        $typeOfTests = TypeOfTest::all();
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
        $laboratoryTest->code = $request->code;
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
        $laboratoryTest->delete();
        return redirect()->route('laboratoryTests.index');
    }
}
