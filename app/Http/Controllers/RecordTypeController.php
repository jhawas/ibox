<?php

namespace App\Http\Controllers;

use App\TypeOfCharge;
use Illuminate\Http\Request;

class RecordTypeController extends Controller
{
    public $page = 'Type of Records';
    public $description = 'List of ';

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
        $recordTypes = TypeOfCharge::where('type_id', 4)->get();
        return view('admin.recordTypes.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'recordTypes' => $recordTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recordTypes.create', [
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
    public function store(Request $request)
    {
        $recordType = new TypeOfCharge;
        // others id
        $recordType->type_id = 4;
        $recordType->code = $request->code;
        $recordType->description = $request->description;
        $recordType->price = $request->price;
        $recordType->save();
        return redirect()->route('recordTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RecordType  $recordType
     * @return \Illuminate\Http\Response
     */
    public function show(TypeOfCharge $recordType)
    {
        return view('admin.recordTypes.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'recordType' => $recordType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecordType  $recordType
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeOfCharge $recordType)
    {
        return view('admin.recordTypes.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'recordType' => $recordType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecordType  $recordType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeOfCharge $recordType)
    {
        $recordType->code = $request->code;
        $recordType->description = $request->description;
        $recordType->price = $request->price;
        $recordType->save();
        return redirect()->route('recordTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecordType  $recordType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeOfCharge $recordType)
    {
        $recordType->delete();
        return redirect()->route('recordTypes.index');
    }
}
