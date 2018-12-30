<?php

namespace App\Http\Controllers;

use App\MedicineType;
use Illuminate\Http\Request;
use App\Http\Requests\MedicineTypeRequest;

class MedicineTypeController extends Controller
{
    public $page = 'Medicine Types';
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
        $medicineTypes = MedicineType::all();
        return view('admin.medicineTypes.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineTypes' => $medicineTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medicineTypes.create', [
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
    public function store(MedicineTypeRequest $request)
    {
        $medicineType = new MedicineType;
        $medicineType->code = $request->code;
        $medicineType->description = $request->description;
        $medicineType->save();
        return redirect()->route('medicineTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineType $medicineType)
    {
        return view('admin.medicineTypes.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineType' => $medicineType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicineType $medicineType)
    {
        return view('admin.medicineTypes.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineType' => $medicineType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function update(MedicineTypeRequest $request, MedicineType $medicineType)
    {
        $medicineType->code = $request->code;
        $medicineType->description = $request->description;
        $medicineType->save();
        return redirect()->route('medicineTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineType $medicineType)
    {
        $medicineType->delete();
        return redirect()->route('medicineTypes.index');
    }
}
