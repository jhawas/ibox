<?php

namespace App\Http\Controllers\API;

use App\TypeOfCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeOfChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $typeOfCharges = TypeOfCharge::with([
            'parent'
        ])->where('price', '>', 0)->get();
        return $typeOfCharges;
    }

    public function dataWithNoParent()
    {
        $typeOfCharges = TypeOfCharge::with([
            'parent'
        ])->where('price', '>', 0)->get();
        return $typeOfCharges;
    }

    public function delete($id = null) {
    	$typeOfCharge = TypeOfCharge::where('id', $id)->first();
        $typeOfCharge->delete();
        return 'success';
    }

    public function edit($id) {
    	$typeOfCharge = TypeOfCharge::where('id', $id)->first();
        return $typeOfCharge;
    }

    public function update(Request $request, $id = null) {
    	$typeOfCharge = TypeOfCharge::where('id', $id)->first();
        $typeOfCharge->save();
        return 'success';
    }

    public function store(Request $request) {
    	$typeOfCharge = new TypeOfCharge;
        $typeOfCharge->save();
        return 'success';
    }
}
