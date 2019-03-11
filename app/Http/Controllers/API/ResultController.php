<?php

namespace App\Http\Controllers\API;

use App\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $results = Result::all();
        return $results;
    }

    public function delete($id = null) {
    	$result = Result::where('id', $id)->first();
        $result->delete();
        return 'success';
    }

    public function edit($id) {
    	$result = Result::where('id', $id)->first();
        return $results;
    }

    public function update(Request $request, $id = null) {
    	$result = Result::where('id', $id)->first();
    	$result->code = $request->code;
    	$result->description = $request->description;
        $result->save();
        return 'success';
    }

    public function store(Request $request) {
    	$result = new Result;
    	$result->code = $request->code;
    	$result->description = $request->description;
        $result->save();
        return 'success';
    }
}
