<?php

namespace App\Http\Controllers\API;

use App\Floor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FloorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $floors = Floor::with([
        	'rooms'
        ])->get();
        return $floors;
    }

    public function delete($id = null) {
    	$floor = Floor::where('id', $id)->first();
        $floor->delete();
        return 'success';
    }

    public function edit($id) {
    	$floor = Floor::where('id', $id)->first();
        return $floor;
    }

    public function update(Request $request, $id = null) {
    	$floor = Floor::where('id', $id)->first();
    	$floor->code = $request->code;
        $floor->description = $request->description;
        $floor->save();
        return 'success';
    }

    public function store(Request $request) {
    	$floor = new Floor;
    	$floor->code = $request->code;
        $floor->description = $request->description;
        $floor->save();
        return 'success';
    }
}
