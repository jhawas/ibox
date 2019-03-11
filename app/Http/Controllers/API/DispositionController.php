<?php

namespace App\Http\Controllers\API;

use App\Disposition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DispositionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $dispositions = Disposition::all();
        return $dispositions;
    }

    public function delete($id = null) {
    	$disposition = Disposition::where('id', $id)->first();
        $disposition->delete();
        return 'success';
    }

    public function edit($id) {
    	$disposition = Disposition::where('id', $id)->first();
        return $disposition;
    }

    public function update(Request $request, $id = null) {
    	$disposition = Disposition::where('id', $id)->first();
    	$disposition->code = $request->code;
    	$disposition->description = $request->description;
        $disposition->save();
        return 'success';
    }

    public function store(Request $request) {
    	$disposition = new Disposition;
    	$disposition->code = $request->code;
    	$disposition->description = $request->description;
        $disposition->save();
        return 'success';
    }
}
