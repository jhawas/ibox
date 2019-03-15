<?php

namespace App\Http\Controllers;

use App\PatientRecord;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public $page = 'In & Out Patient';
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
        return view('admin.records.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'type_of_patient' => 0,
        ]);
    }

    // type of patient
    public function show($type_of_patient) {
        return view('admin.records.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'type_of_patient' => $type_of_patient,
        ]);
    }

}
