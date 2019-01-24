<?php

namespace App\Http\Controllers;

use App\Round;
use App\PatientRecord;
use Illuminate\Http\Request;

class RoundController extends Controller
{
    public $page = 'Rounds';
    public $description = 'List of all ';

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
        $rounds = Round::all();
        return view('admin.rounds.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'rounds' => $rounds
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
        return view('admin.rounds.create', [
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
        $round = new Round;
        $round->patient_record_id = $request->patientRecord;
        $round->description = $request->description;
        $round->time = $request->time;
        $round->date = $request->date;
        $round->save();
        return redirect()->route('rounds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function show(Round $round)
    {
        return view('admin.rounds.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'round' => $round,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function edit(Round $round)
    {
        $patientRecords = PatientRecord::all();
        return view('admin.rounds.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'round' => $round,
            'patientRecords' => $patientRecords,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Round $round)
    {
        $round->description = $request->description;
        $round->patient_record_id = $request->patientRecord;
        $round->time = $request->time;
        $round->date = $request->date;
        $round->save();
        return redirect()->route('rounds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Round  $round
     * @return \Illuminate\Http\Response
     */
    public function destroy(Round $round)
    {
        $round->delete();
        return redirect()->route('rounds.index');
    }
}
