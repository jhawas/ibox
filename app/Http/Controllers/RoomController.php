<?php

namespace App\Http\Controllers;

use App\Room;
use App\Floor;
use App\TypeOfRoom;
use Illuminate\Http\Request;
use App\Http\Requests\RoomsRequest;

class RoomController extends Controller
{
    public $page = 'Rooms';
    public $description = 'List of all ';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with([
            'records' => function($query) {
                
            }
        ])->get();
        // return $rooms;
        return view('admin.rooms.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'rooms' => $rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $floors = Floor::all();
        $roomTypes = TypeOfRoom::all();
        return view('admin.rooms.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'floors' => $floors,
            'roomTypes' => $roomTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomsRequest $request)
    {
        $room = new Room;
        $room->code = $request->code;
        $room->description = $request->description;
        $room->floor_id = $request->floor;
        $room->type_of_room_id = $request->roomType;
        $room->capacity = $request->capacity;
        $room->save();
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'room' => $room,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $floors = Floor::all();
        $roomTypes = TypeOfRoom::all();
        return view('admin.rooms.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'floors' => $floors,
            'roomTypes' => $roomTypes,
            'room' => $room
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomsRequest $request, Room $room)
    {
        $room->code = $request->code;
        $room->description = $request->description;
        $room->floor_id = $request->floor;
        $room->type_of_room_id = $request->roomType;
        $room->capacity = $request->capacity;
        $room->save();
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index');
    }
}
