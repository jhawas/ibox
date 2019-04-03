<?php

namespace App\Http\Controllers\API;

use App\Insurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InsuranceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $insurances = Insurance::all();
        return $insurances;
    }

    public function delete($id = null) {
    	$insurance = Insurance::where('id', $id)->first();
        $insurance->delete();
        return 'success';
    }

    public function edit($id) {
    	$insurance = Insurance::where('id', $id)->first();
        return $insurance;
    }

    public function update(Request $request, $id = null) {
    	$insurance = Insurance::where('id', $id)->first();
    	$insurance->code = $request->code;
        $insurance->description = $request->description;
        $insurance->save();
        return 'success';
    }

    public function store(Request $request) {
    	$insurance = new Insurance;
    	$insurance->code = $request->code;
        $insurance->description = $request->description;
        $insurance->save();
        return 'success';
    }
}
