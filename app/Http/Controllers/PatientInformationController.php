<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use Illuminate\Http\Request;

class PatientInformationController extends Controller
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
        $patientInformations = User::with([
            'records' => function($record) {
                $record->with([
                    'user',
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
        ])->where('is_user', 0)->get();
        // return $patientInformations;
        return view('admin.patientInformations.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientInformations' => $patientInformations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patientInformations.create', [
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
        $user_role = new UserRole(['role_id' => 6]); // patient id
        $user = new User;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->is_user = 0;
        $user->birthdate = $request->birthdate;
        $user->sex = $request->sex;
        $user->weight = $request->weight;
        $user->height = $request->height;
        $user->religion = $request->religion;
        $user->occupation = $request->occupation;
        $user->specialty = $request->specialty;
        $user->degree = $request->degree;
        $user->save();
        $user->user_role()->save($user_role);
        return redirect()->route('patientInformations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.patientInformations.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientInformation' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.patientInformations.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientInformation' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->sex = $request->sex;
        $user->weight = $request->weight;
        $user->height = $request->height;
        $user->religion = $request->religion;
        $user->occupation = $request->occupation;
        $user->specialty = $request->specialty;
        $user->degree = $request->degree;
        $user->save();
        return redirect()->route('patientInformations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('patientInformations.index');
    }

    /**
     * Show print page.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        $patientInformations = User::with([
            'records' => function($record) {
                $record->with([
                    'user',
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
        ])->where('is_user', 0)->get();
        // return $patientInformations;
        return view('admin.patientInformations.print', [
            'patientInformations' => $patientInformations,
        ]);
    }

    /**
     * Show print history page.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function printHistory(User $user) 
    {
        return view('admin.patientInformations.history', [
            'patientInformation' => $user,
        ]);
    }
}
