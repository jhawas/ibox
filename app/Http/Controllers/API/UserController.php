<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $users = User::with([
        	'user_role' => function($user_role) {
        		$user_role->with(['role']);
        	}
        ])->get();
        return $users;
    }

    public function delete($id = null) {
    	$user = User::where('id', $id)->first();
        $user->delete();
        return 'success';
    }

    public function edit($id) {
    	$user = User::where('id', $id)->first();
        return $user;
    }

    public function update(Request $request, $id = null) {
    	$user = User::where('id', $id)->first();
    	$user->code = $request->code;
        $user->description = $request->description;
        $user->save();
        return 'success';
    }

    public function store(Request $request) {
    	$user = new User;
    	$user->code = $request->code;
        $user->description = $request->description;
        $user->save();
        return 'success';
    }
}
