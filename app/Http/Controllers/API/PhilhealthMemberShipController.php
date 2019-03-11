<?php

namespace App\Http\Controllers\API;

use App\PhilhealthMembership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhilhealthMemberShipController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $philhealthMemberships = PhilhealthMembership::all();
        return $philhealthMemberships;
    }

    public function delete($id = null) {
    	$philhealthMembership = PhilhealthMembership::where('id', $id)->first();
        $philhealthMembership->delete();
        return 'success';
    }

    public function edit($id) {
    	$philhealthMembership = PhilhealthMembership::where('id', $id)->first();
        return $philhealthMembership;
    }

    public function update(Request $request, $id = null) {
    	$philhealthMembership = PhilhealthMembership::where('id', $id)->first();
    	$philhealthMembership->code = $request->code;
    	$philhealthMembership->description = $request->description;
        $philhealthMembership->save();
        return 'success';
    }

    public function store(Request $request) {
    	$philhealthMembership = new PhilhealthMembership;
    	$philhealthMembership->code = $request->code;
    	$philhealthMembership->description = $request->description;
        $philhealthMembership->save();
        return 'success';
    }
}
