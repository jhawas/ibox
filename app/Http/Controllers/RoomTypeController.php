<?php

namespace App\Http\Controllers;

use App\RoomType;
use Illuminate\Http\Request;
use App\Http\Requests\RoomTypeRequest;

class RoomTypeController extends Controller
{
    public $page = 'Room Types';
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
        $roomTypes = RoomType::all();
        return view('admin.roomTypes.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'roomTypes' => $roomTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roomTypes.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomTypeRequest $request)
    {
        $roomType = new RoomType;
        $roomType->code = $request->code;
        $roomType->description = $request->description;
        $roomType->save();
        return redirect()->route('roomTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function show(RoomType $roomType)
    {
        return view('admin.roomTypes.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'roomType' => $roomType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        return view('admin.roomTypes.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'roomType' => $roomType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(RoomTypeRequest $request, RoomType $roomType)
    {
        $roomType->code = $request->code;
        $roomType->description = $request->description;
        $roomType->save();
        return redirect()->route('roomTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return redirect()->route('roomTypes.index');
    }
}