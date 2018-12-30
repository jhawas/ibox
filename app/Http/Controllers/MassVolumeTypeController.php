<?php

namespace App\Http\Controllers;

use App\MassVolumeType;
use Illuminate\Http\Request;
use App\Http\Requests\MassVolumeTypeRequest;

class MassVolumeTypeController extends Controller
{
    public $page = 'Mass and Volume';
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
        $massVolumeTypes = MassVolumeType::all();
        return view('admin.massVolumeTypes.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'massVolumeTypes' => $massVolumeTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.massVolumeTypes.create', [
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
    public function store(MassVolumeTypeRequest $request)
    {
        $massVolumeType = new MassVolumeType;
        $massVolumeType->code = $request->code;
        $massVolumeType->description = $request->description;
        $massVolumeType->save();
        return redirect()->route('massVolumeTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MassVolumeType  $massVolumeType
     * @return \Illuminate\Http\Response
     */
    public function show(MassVolumeType $massVolumeType)
    {
        return view('admin.massVolumeTypes.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'massVolumeType' => $massVolumeType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MassVolumeType  $massVolumeType
     * @return \Illuminate\Http\Response
     */
    public function edit(MassVolumeType $massVolumeType)
    {
        return view('admin.massVolumeTypes.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'massVolumeType' => $massVolumeType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MassVolumeType  $massVolumeType
     * @return \Illuminate\Http\Response
     */
    public function update(MassVolumeTypeRequest $request, MassVolumeType $massVolumeType)
    {
        $massVolumeType->code = $request->code;
        $massVolumeType->description = $request->description;
        $massVolumeType->save();
        return redirect()->route('massVolumeTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MassVolumeType  $massVolumeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MassVolumeType $massVolumeType)
    {
        $massVolumeType->delete();
        return redirect()->route('massVolumeTypes.index');
    }
}
