<?php

namespace App\Http\Controllers\API;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api']);
    }

    public function data()
    {
        $rooms = Room::all();
        return $rooms;
    }

    public function delete($id = null) {
    	$room = Room::where('id', $id)->first();
        $room->delete();
        return 'success';
    }

    public function edit($id) {
    	$room = Room::where('id', $id)->first();
        return $room;
    }

    public function update(Request $request, $id = null) {
    	$room = Room::where('id', $id)->first();
    	$room->code = $request->code;
        $room->description = $request->description;
        $room->floor_id = $request->floor;
        // $room->type_of_room_id = $request->roomType;
        $room->capacity = $request->capacity;
        $room->save();
        return 'success';
    }

    public function store(Request $request) {
    	$room = new Room;
    	$room->code = $request->code;
        $room->description = $request->description;
        $room->floor_id = $request->floor;
        // $room->type_of_room_id = $request->roomType;
        $room->capacity = $request->capacity;
        $room->save();
        return 'success';
    }
}
