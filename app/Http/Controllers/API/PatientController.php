<?php

namespace App\Http\Controllers\API;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function patients()
    {
        $patients = Patient::all();
        return $patients;
    }
}
