<?php

namespace App\Http\Controllers;

use App\Floor;
use Illuminate\Http\Request;
use App\Http\Requests\FloorRequest;

class FloorController extends Controller
{
    public $page = 'Floors';
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
        $floors = Floor::all();
        return view('admin.floors.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'floors' => $floors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.floors.create', [
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
    public function store(FloorRequest $request)
    {
        $floor = new Floor;
        $floor->code = $request->code;
        $floor->description = $request->description;
        $floor->save();
        return redirect()->route('floors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        return view('admin.floors.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'floor' => $floor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor)
    {
        return view('admin.floors.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'floor' => $floor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(FloorRequest $request, Floor $floor)
    {
        $floor->code = $request->code;
        $floor->description = $request->description;
        $floor->save();
        return redirect()->route('floors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor)
    {
        $floor->delete();
        return redirect()->route('floors.index');
    }
}
