<?php

namespace App\Http\Controllers;

use App\Diagnose;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    public $page = 'Diagnoses';
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
        $diagnoses = Diagnose::all();
        return view('admin.diagnoses.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'diagnoses' => $diagnoses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.diagnoses.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
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
        $diagnose = new Diagnose;
        $diagnose->code = $request->code;
        $diagnose->description = $request->description;
        $diagnose->save();
        return redirect()->route('diagnoses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnose $diagnose)
    {
        return view('admin.diagnoses.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'diagnose' => $diagnose,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnose $diagnose)
    {
        return view('admin.diagnoses.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'diagnose' => $diagnose,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnose $diagnose)
    {
        $diagnose->code = $request->code;
        $diagnose->description = $request->description;
        $diagnose->save();
        return redirect()->route('diagnoses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnose $diagnose)
    {
        $diagnose->delete();
        return redirect()->route('diagnoses.index');
    }
}
