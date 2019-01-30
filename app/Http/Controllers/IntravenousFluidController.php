<?php

namespace App\Http\Controllers;

use App\IntravenousFluid;
use App\PatientRecord;
use Illuminate\Http\Request;

class IntravenousFluidController extends Controller
{

    public $page = 'Intravenous Fluids';
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
        $intravenousFluids = IntravenousFluid::all();
        return view('admin.intravenousFluids.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'intravenousFluids' => $intravenousFluids
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
        return view('admin.intravenousFluids.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecords' => $patientRecords,
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
        $intravenousFluid = new IntravenousFluid;
        $intravenousFluid->patient_record_id = $request->patientRecord;
        $intravenousFluid->date = $request->date;
        $intravenousFluid->time = $request->time;
        $intravenousFluid->bot_no = $request->bot_no;
        $intravenousFluid->kind_of_solution = $request->kind_of_solution;
        $intravenousFluid->vol = $request->vol;
        $intravenousFluid->gtss = $request->gtss;
        $intravenousFluid->remarks = $request->remarks;
        $intravenousFluid->nurse_id = \Auth::user()->id;
        $intravenousFluid->save();
        return redirect()->route('intravenousFluids.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IntravenousFluid  $intravenousFluid
     * @return \Illuminate\Http\Response
     */
    public function show(IntravenousFluid $intravenousFluid)
    {
        return view('admin.intravenousFluids.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'intravenousFluid' => $intravenousFluid,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IntravenousFluid  $intravenousFluid
     * @return \Illuminate\Http\Response
     */
    public function edit(IntravenousFluid $intravenousFluid)
    {
        $patientRecords = PatientRecord::all();
        return view('admin.intravenousFluids.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'intravenousFluid' => $intravenousFluid,
            'patientRecords' => $patientRecords,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IntravenousFluid  $intravenousFluid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IntravenousFluid $intravenousFluid)
    {
        $intravenousFluid->patient_record_id = $request->patientRecord;
        $intravenousFluid->date = $request->date;
        $intravenousFluid->time = $request->time;
        $intravenousFluid->bot_no = $request->bot_no;
        $intravenousFluid->kind_of_solution = $request->kind_of_solution;
        $intravenousFluid->vol = $request->vol;
        $intravenousFluid->gtss = $request->gtss;
        $intravenousFluid->remarks = $request->remarks;
        $intravenousFluid->nurse_id = \Auth::user()->id;
        $intravenousFluid->save();
        return redirect()->route('intravenousFluids.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IntravenousFluid  $intravenousFluid
     * @return \Illuminate\Http\Response
     */
    public function destroy(IntravenousFluid $intravenousFluid)
    {
        $intravenousFluid->delete();
        return redirect()->route('intravenousFluids.index');
    }
}
