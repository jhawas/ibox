<?php

namespace App\Http\Controllers\API;

use App\TypeOfLaboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfLaboratoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $data = TypeOfLaboratory::all();
        return $data;
    }
}
