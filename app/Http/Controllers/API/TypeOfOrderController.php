<?php

namespace App\Http\Controllers\API;

use App\TypeOfOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $typeOfOrder = TypeOfOrder::all();
        return $typeOfOrder;
    }
}
