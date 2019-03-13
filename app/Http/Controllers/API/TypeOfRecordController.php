<?php

namespace App\Http\Controllers\API;

use App\TypeOfRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data($patient_record_id = null)
    {
        $typeOfRecords = TypeOfRecord::all();
        return $typeOfRecords;
    }
}
