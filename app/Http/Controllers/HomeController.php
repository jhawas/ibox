<?php

namespace App\Http\Controllers;

use App\User;
use App\Patient;
use App\PatientRecord;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $page = 'Dashbaord';
    public $description = 'Monitoring Page';
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users =  User::all();
        $patients = Patient::all();
        $inPatients = PatientRecord::where('type_of_record_id', 2)->get();
        $outPatients = PatientRecord::where('type_of_record_id', 1)->get();
        return view('home', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'users' => $users,
            'patients' => $patients,
            'inPatients' => $inPatients,
            'outPatients' => $outPatients
        ]);
    }
}
