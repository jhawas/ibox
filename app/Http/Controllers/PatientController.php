<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public $page = 'Patient Information';
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
        $patients = Patient::with([
            'records' => function($record) {
                $record->with([
                    'patient',
                    'recordType',
                    'room',
                    'diagnoses' => function($diagnoses) {
                        $diagnoses->with([
                            'diagnose'
                        ]);
                    },
                    'billings' => function($billing) {
                        $billing->with([
                            'charge'
                        ]);
                    },
                ]);
            }
        ])->get();
        // return $patients;
        return view('admin.patients.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patients' => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patients.create', [
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
        $patient = new Patient;
        $patient->first_name = $request->first_name;
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->suffix = $request->suffix;
        $patient->birthdate = $request->birthdate;
        $patient->sex = $request->sex;
        $patient->religion = $request->religion;
        $patient->civil_status = $request->civil_status[0];
        $patient->address = $request->address;
        $patient->spouse = $request->spouse;
        $patient->spouse_address = $request->spouse_address;
        $patient->mother = $request->mother;
        $patient->father = $request->father;
        $patient->e_name = $request->e_name;
        $patient->e_contact = $request->e_contact;
        $patient->e_address = $request->e_address;
        $patient->save();
        return redirect()->route('patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('admin.patients.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patient' => $patient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patient' => $patient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->first_name = $request->first_name;
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->suffix = $request->suffix;
        $patient->birthdate = $request->birthdate;
        $patient->sex = $request->sex;
        $patient->religion = $request->religion;
        $patient->civil_status = $request->civil_status[0];
        $patient->address = $request->address;
        $patient->spouse = $request->spouse;
        $patient->spouse_address = $request->spouse_address;
        $patient->mother = $request->mother;
        $patient->father = $request->father;
        $patient->e_name = $request->e_name;
        $patient->e_contact = $request->e_contact;
        $patient->e_address = $request->e_address;
        $patient->save();
        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index');
    }

    /**
     * Show print page.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        $patients = Patient::with([
            'records' => function($record) {
                $record->with([
                    'patient',
                    'recordType',
                    'room',
                    'diagnoses' => function($diagnoses) {
                        $diagnoses->with([
                            'diagnose'
                        ]);
                    },
                    'billings' => function($billing) {
                        $billing->with([
                            'charge'
                        ]);
                    }
                ]);
            }
        ])->get();
        // return $patients;
        return view('admin.patients.print', [
            'patients' => $patients,
        ]);
    }

    /**
     * Show print history page.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function printHistory(Patient $patient) 
    {
        return view('admin.patients.history', [
            'patient' => $patient,
        ]);
    }
}
